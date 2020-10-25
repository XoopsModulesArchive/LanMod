<?php

declare(strict_types=1);

// ------------------------------------------------------------------------- //
//                XOOPS - PHP Content Management System                      //
//                       <https://www.xoops.org>                             //
// ------------------------------------------------------------------------- //
// Based on:								     //
// myPHPNUKE Web Portal System - http://myphpnuke.com/	  		     //
// PHP-NUKE Web Portal System - http://phpnuke.org/	  		     //
// Thatware - http://thatware.org/					     //
// ------------------------------------------------------------------------- //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
// ------------------------------------------------------------------------- //
require dirname(__DIR__, 2) . '/mainfile.php';

if ('Submit' == $Submit) {
    global $xoopsDB, $xoopsUser;

    if ($xoopsUser) {
        $luid = $xoopsUser->getVar('uid');
    }

    if ('go' == $select) {
        $result = $xoopsDB->query('SELECT userid FROM ' . $xoopsDB->prefix('lan_going') . " WHERE userid='$luid'");

        if (0 == $xoopsDB->getRowsNum($result)) {
            $result = $xoopsDB->query('INSERT INTO ' . $xoopsDB->prefix('lan_going') . " VALUES(NULL, '$luid')");
        }
    } else {
        $result = $xoopsDB->query('SELECT userid FROM ' . $xoopsDB->prefix('lan_going') . " WHERE userid='$luid'");

        [$lluid] = $xoopsDB->fetchRow($result);

        if ($result) {
            $xoopsDB->query('DELETE FROM ' . $xoopsDB->prefix('lan_going') . " WHERE userid='$lluid'");
        }
    }
}

if ('show' == $map) {
    map();

    exit;
}
if ('show' == $regis) {
    regis();

    exit;
}
if ('show' == $spons) {
    spons();

    exit;
}
if ('show' == $going) {
    going();

    exit;
}
    map();
    exit;

// Display The Party Information
function map()
{
    global $xoopsConfig, $xoopsDB, $xoopsUser, $xoopsTheme, $xoopsLogger;

    $result = $xoopsDB->query('select eventdate, location, details, games, requirments, rules, suggestions from ' . $xoopsDB->prefix('lan'));

    [$eventdate, $location, $details, $games, $requirments, $rules, $suggestions] = $xoopsDB->fetchRow($result);

    require dirname(__DIR__, 2) . '/header.php';

    OpenTable();

    print '<b>' . _MD_NEXTEVENT . "</b>
		   <b>$eventdate</b><br><br><br>
			
			<b>" . _MD_LOCATION . "</b><br>
			$location<br><br>
			
			<b>" . _MD_DETAILS . "</b><br>
			$details<br><br>
			
			<b>" . _MD_GAMESERVERS . '</b> - (<a href="' . XOOPS_URL . '/modules/contact/">' . _MD_SUGGESTURGAME . "</a>)<br>
			$games<br><br>
			
			<b>" . _MD_REQUIREMENTS . "</b><br>
			$requirments<br><br>

			<b>" . _MD_RULES . "</b><br>
			$rules<br><br>

			<p>" . _MD_QUESTANDSUGG . "<br>
			$suggestions<br><br>";

    CloseTable();

    require dirname(__DIR__, 2) . '/footer.php';
}

// Display The open to signup or not.
function regis()
{
    global $xoopsConfig, $xoopsDB, $xoopsUser, $xoopsTheme, $xoopsLogger;

    if (!$xoopsUser) {
        redirect_header(XOOPS_URL . '/user.php', 1, _MUSTBEREG);

        die();
    }

    $luid = $xoopsUser->getvar('uid');

    $result = $xoopsDB->query('SELECT id FROM ' . $xoopsDB->prefix('lan_going') . " WHERE userid='$luid'");

    $lluid = ($xoopsDB->getRowsNum($result) > 0) ? 1 : 0;

    $result = $xoopsDB->query('select * from ' . $xoopsDB->prefix('lan'));

    [$id, $version, $goingtext, $goingselect, $notgoingselect, $goingok, $notgoingok, $eventdate, $location, $details, $games, $requirments, $rules, $suggestions, $adminemail] = $xoopsDB->fetchRow($result);

    include '../../header.php';

    OpenTable();

    if ($lluid) {
        print (string)$goingok;
    } else {
        print (string)$notgoingok;
    }

    print "<br><br><br>
		<form action=\"\" method=\"post\">
		  <select name=\"select\">
		    <option value=\"go\">$goingselect</option>
			<option value=\"no\">$notgoingselect</option>
		  </select>
		
		  <input type=\"submit\" name=\"Submit\" value=\"" . _SUBMIT . '">
		</form>';

    CloseTable();

    print '<br>';

    OpenTable();

    print '<b>' . _MD_NEXTEVENT . "</b>
		   <b>$eventdate</b><br><br><br>
			
			<b>" . _MD_LOCATION . "</b><br>
			$location<br><br>
			
			<b>" . _MD_DETAILS . "</b><br>
			$details<br><br>
			
			<b>" . _MD_GAMESERVERS . '</b> - (<a href="' . XOOPS_URL . '/modules/contact/">' . _MD_SUGGESTURGAME . "</a>)<br>
			$games<br><br>
			
			<b>" . _MD_REQUIREMENTS . "</b><br>
			$requirments<br><br>

			<b>" . _MD_RULES . "</b><br>
			$rules<br><br>

			<p>" . _MD_QUESTANDSUGG . "<br>
			$suggestions<br><br>";

    CloseTable();

    include '../../footer.php';
}

// dispay the registered users.

function going()
{
    global $xoopsConfig, $xoopsDB, $xoopsUser, $xoopsTheme, $xoopsLogger;

    $result = $xoopsDB->query('select peoplegoinglisttext from ' . $xoopsDB->prefix('lan'));

    [$goingtext] = $xoopsDB->fetchRow($result);

    $result = $xoopsDB->query('SELECT userid FROM ' . $xoopsDB->prefix('lan_going'));

    require dirname(__DIR__, 2) . '/header.php';

    OpenTable();

    print "$goingtext<br>";

    while (list($userid) = $xoopsDB->fetchRow($result)) {
        $checkuser = new XoopsUser($userid);

        print '<tr>';

        print '<td><a href="' . XOOPS_URL . '/userinfo.php?uid=' . $checkuser->getVar('uid') . '">' . $checkuser->getVar('uname') . '</a></td>';

        print '<td><a href="mailto:' . $checkuser->getVar('email') . '">' . $checkuser->getVar('email') . '</a></td>';

        print '<td>' . $checkuser->getVar('user_intrest') . '</td>';

        print '</tr>';
    }

    CloseTable();

    include '../../footer.php';
}

// Show the sponsors.
function spons()
{
    global $xoopsConfig, $xoopsDB, $xoopsUser, $xoopsTheme, $xoopsLogger;

    include '../../header.php';

    $query = 'select * from ' . $xoopsDB->prefix('lan_spons');

    $result = $xoopsDB->query($query) or die("Error in query: $query. " . $xoopsDB->error());

    OpenTable();

    print _MD_SPONSORS . '<br>';

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        print "<br>$row[1]<br><a href=\"$row[3]\" target=\"_blank\"><img src=\"$row[2]\" border=\"0\"></a><br><br>$row[4]<br><br><br>";
    }

    CloseTable();

    include '../../footer.php';
}
