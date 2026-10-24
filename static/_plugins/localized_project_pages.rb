# Generates a page per project and per language (/projects/<slug>/ and /fr/projects/<slug>/),
# exposes projects sorted the way the projects page lists them, and finds each project's images.
module LocalizedProjectPages
  IMAGES_DIR = "/assets/img/projects"
  IMAGE_EXTENSIONS = %w[.png .jpg .jpeg .gif .webp .svg].freeze
  REQUIRED_FIELDS = %w[name category start_year].freeze

  class Generator < Jekyll::Generator
    safe true

    def generate(site)
      projects = site.collections["projects"].docs
      validate(site, projects)
      assign_images(site, projects)

      # Within a category: most recent first, then by name (case-insensitive, like the original database collation)
      site.data["projects_by_category"] = projects
        .sort_by { |doc| [-doc.data["start_year"], doc.data["name"].downcase] }
        .group_by { |doc| doc.data["category"] }

      site.data["featured_projects"] = projects
        .select { |doc| doc.data["featured"] }
        .sort_by { |doc| doc.data["start_year"] }

      site.config["languages"].each do |lang|
        prefix = lang == site.config["languages"].first ? "" : "/#{lang}"

        projects.each do |doc|
          page = Jekyll::PageWithoutAFile.new(site, site.source, "#{prefix}/projects/#{doc.data["slug"]}", "index.html")
          page.data.merge!(
            "layout" => "project",
            "lang" => lang,
            "nav" => "projects",
            "title" => doc.data["name"],
            "project" => doc,
            # The collection isn't rendered, so this is still the raw Markdown
            "description" => lang == "fr" ? doc.data["description_fr"] : doc.content
          )
          site.pages << page
        end
      end
    end

    private

    # Fail with a clear message rather than a cryptic error, or a project silently missing from the projects page
    def validate(site, projects)
      categories = site.data["categories"].map { |category| category["key"] }

      projects.each do |doc|
        missing = REQUIRED_FIELDS.select { |field| doc.data[field].nil? }
        unless missing.empty?
          raise Jekyll::Errors::FatalException, "#{doc.relative_path}: missing #{missing.join(", ")}"
        end

        unless categories.include?(doc.data["category"])
          raise Jekyll::Errors::FatalException,
                "#{doc.relative_path}: unknown category '#{doc.data["category"]}' (see _data/categories.yml)"
        end
      end
    end

    # Images live in assets/img/projects/<slug>/: `thumbnail.*`, and `screenshot*` files shown in filename order.
    # Projects without a thumbnail use their first screenshot.
    def assign_images(site, projects)
      images = site.static_files
        .select { |file| file.url.start_with?("#{IMAGES_DIR}/") && IMAGE_EXTENSIONS.include?(File.extname(file.url).downcase) }
        .group_by { |file| File.basename(File.dirname(file.url)) }

      projects.each do |doc|
        slug = doc.data["slug"]
        urls = (images.delete(slug) || []).map(&:url)
        screenshots = urls.select { |url| File.basename(url).start_with?("screenshot") }.sort
        thumbnail = urls.find { |url| File.basename(url, ".*") == "thumbnail" } || screenshots.first

        Jekyll.logger.warn "Projects:", "no images found in #{IMAGES_DIR}/#{slug}/" if thumbnail.nil?
        doc.data["screenshot_urls"] = screenshots
        doc.data["thumbnail_url"] = thumbnail
      end

      # Remaining folders belong to unpublished projects, or to none at all
      images.each_key do |dir|
        next if File.exist?(site.in_source_dir("_projects", "#{dir}.md"))

        Jekyll.logger.warn "Projects:", "#{IMAGES_DIR}/#{dir}/ doesn't match any project"
      end
    end
  end
end
