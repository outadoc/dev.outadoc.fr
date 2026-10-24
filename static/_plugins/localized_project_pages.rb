# Generates a page per project and per language (/projects/<slug>/ and /fr/projects/<slug>/),
# and exposes projects sorted the way the projects page lists them.
module LocalizedProjectPages
  class Generator < Jekyll::Generator
    safe true

    def generate(site)
      projects = site.collections["projects"].docs

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
  end
end
