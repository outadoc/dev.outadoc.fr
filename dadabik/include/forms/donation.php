<?php
/*
***********************************************************************************
DaDaBIK (DaDaBIK is a DataBase Interfaces Kreator) http://www.dadabik.org/
Copyright (C) 2001-2012  Eugenio Tacchini

This program is distributed "as is" and WITHOUT ANY WARRANTY, either expressed or implied, without even the implied warranties of merchantability or fitness for a particular purpose.

This program is distributed under the terms of the DaDaBIK license, which is included in this package (see dadabik_license.txt). At a glance, you can use this program and you can modifiy it to create a database application for you or for other people but you cannot redistribute the program files in any format. All the details, including examples, in dadabik_license.txt.

If you are unsure about what you are allowed to do with this license, feel free to contact eugenio.tacchini@gmail.com
***********************************************************************************
*/
?>


<p>
<form method="post" action="admin.php?function=process_donation">

<table cellpadding="5">
<tr>
<td valign="top">
<img src="http://www.dadabik.org/images/eugenio.jpg"></td>
<td>Hi, I'm Eugenio Tacchini, the author of DaDaBIK.</br></br>

You have installed DaDaBIK on <?php echo substr($date_time_installation, 0, 10); ?>: if you are using it and you find this program useful, you are supposed to donate some money, based on how much you can afford and how much DaDaBIK is useful for you. Consider that in the last years many commercial applications having the same purposes of DaDaBIK has been created and to use them you have to pay a price, even if you don't get the source code.</p>

<p>DaDaBIK is made of thousands of code lines and costed me hundreds of work hours; if you can't afford a big donation (for example you are a student or you live in a poor country) consider that even one euro could be a good contribution if everybody gave it.</p>


<input type="radio" name="dan" value="1" checked>Ok, I want to make a donation
</br><input type="radio" name="dan" value="2">I already made a donation in the past
<!--</br><input type="radio" name="dan" value="3">Remind me in a week-->
</br><input type="radio" name="dan" value="4">I don't want to donate (if you want you can specify the reason in the feedback box below)

<p>You also have the opportunity to send a feedback about your DaDaBIK experience (also specify your name and e-mail if you need an answer)</p>
<textarea name="dfe" cols="80" rows="10"></textarea>

</br></br><input type="submit" value="Next &gt;&gt;"> (the information you submit in this page will be send to www.dadabik.org, you need an Internet connection)
</td>
</tr>

</form>

