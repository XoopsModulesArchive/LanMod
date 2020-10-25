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

require dirname(__DIR__, 3) . '/include/cp_header.php';

/*********************************************************/
/* LAN Admin Function                                    */
/*********************************************************/

if ('update' == $Action) {
    $xoopsDB->query(
        'UPDATE '
        . $xoopsDB->prefix('lan')
        . " set id=1,version='$versionn', peoplegoinglisttext='$goingtextn',goingselect='$goingselectn',notgoingselect='$notgoingselectn',goingwelcome='$goingokn',notgoingwelcome='$notgoingokn',eventdate='$eventdaten',location ='$locationn',details ='$detailsn',games ='$gamesn',requirments='$requirmentsn',rules='$rulesn',suggestions ='$suggestionsn',adminemail ='$adminemailn' where id=1"
    );

    redirect_header('index.php?op=lan', 1, _MD_DBUPDATED);

    exit();
}

if ('update' == $Submit) {
    $xoopsDB->query(
        'UPDATE '
        . $xoopsDB->prefix('lan')
        . " set id=1,version='$versionn', peoplegoinglisttext='$goingtextn',goingselect='$goingselectn',notgoingselect='$notgoingselectn',goingwelcome='$goingokn',notgoingwelcome='$notgoingokn',eventdate='$eventdaten',location ='$locationn',details ='$detailsn',games ='$gamesn',requirments='$requirmentsn',rules='$rulesn',suggestions ='$suggestionsn',adminemail ='$adminemailn' where id=1"
    );

    redirect_header('index.php?op=lan', 1, _MD_DBUPDATED);

    exit();
}

if ('addspons' == $Submit) {
    $xoopsDB->query('INSERT INTO ' . $xoopsDB->prefix('lan_spons') . " (name,bannerurl,linkurl,bannertext ) VALUES ('$namen ','$bannerurln ','$linkurln ','$bannertextn')");

    redirect_header('index.php?op=lan', 1, _MD_DBUPDATED);

    exit();
}

if ('updaterec' == $Submit) {
    $xoopsDB->query('UPDATE ' . $xoopsDB->prefix('lan_spons') . " set name='$namen',bannerurl='$bannerurln',linkurl='$linkurln',bannertext='$bannertextn' where id='$edit'");

    redirect_header('index.php?op=lan', 1, _MD_DBUPDATED);

    exit();
}

if ('emptylist' == $Submit) {
    $xoopsDB->query('DELETE FROM `nuke_lan_going`');

    redirect_header('index.php?op=lan', 1, _MD_DBUPDATED);

    exit();
}

if ('updateblock' == $Submit) {
    $xoopsDB->query('UPDATE ' . $xoopsDB->prefix('lan_blockinfo') . " set id='1',date='$daten',regstatus='$statusn' where id='1'");

    redirect_header('index.php?op=lan', 1, _MD_DBUPDATED);

    exit();
}

if ($remove) {
    $xoopsDB->query('DELETE FROM ' . $xoopsDB->prefix('lan_spons') . " WHERE id='$remove'");

    redirect_header('index.php?op=lan', 1, _MD_DBUPDATED);

    exit();
}

if ($edit) {
    xoops_cp_header();

    OpenTable();

    $query = 'select * from ' . $xoopsDB->prefix('lan_spons') . " where id = '$edit'";

    $result = $xoopsDB->query($query) or die(_MD_ERRORINQU . " $query. " . $xoopsDB->error());

    print _MD_A_SPONSTEXT . '<br>';

    while (false !== ($row = $xoopsDB->fetchRow($result))) {
        print '<form action="" method="POST">';

        print '<tr>';

        print '<td valign=top class="even">' . _MD_A_NAME . '</td>';

        print "<td class=\"odd\"><input type=\"text\" name=\"namen\" value=\"$row[1]\"></td>";

        print '</tr>';

        print '<tr>';

        print '<td valign=top class="even">' . _MD_A_BANNERURL . '</td>';

        print '<td class="odd">' . _MD_A_BANNERURLDESC . "<br><input type=\"text\" name=\"bannerurln\" value=\"$row[2]\"></td>";

        print '</tr>';

        print '<tr>';

        print '<td valign=top class="even">' . _MD_A_LINKURL . '</td>';

        print '<td class="odd">' . _MD_A_LINKURLDESC . "<br><input type=\"text\" name=\"linkurln\" value=\"$row[3]\"></td>";

        print '</tr>';

        print '<tr>';

        print '<td valign=top class="even">' . _MD_A_BANNERTEXT . '</td>';

        print '<td class="odd">' . _MD_A_BANNERTEXT . "<br><textarea name=\"bannertextn\" cols=\"50\" rows=\"10\">$row[4]</textarea></td>";

        print '</tr>';

        print '<tr>';

        print '<td valign=top class="even">' . _MD_A_UPDATE . '</td>';

        print "<td class=\"odd\"><input type=\"hidden\" name=\"edit\" value=\"$edit\"><input type=\"submit\" name=\"Submit\" value=\"" . _MD_A_BUPDATE . '"></td>';

        print '</tr>';
    }

    CloseTable();

    xoops_cp_footer();

    exit();
}

function lanmain()
{
    global $xoopsDB;

    $result = $xoopsDB->query('select * from ' . $xoopsDB->prefix('lan'));

    [$id, $version, $goingtext, $goingselect, $notgoingselect, $goingok, $notgoingok, $eventdate, $location, $details, $games, $requirments, $rules, $suggestions, $adminemail] = $xoopsDB->fetchRow($result);

    xoops_cp_header();

    OpenTable();

    print '<form action="index.php" method="POST">';

    print '<tr>';

    print '<td valign=top class="even">' . _MD_A_VERSION . '</td>';

    print '<td class="odd">' . _MD_A_VERSIONDESC . "<br><input type=\"text\" name=\"versionn\" value=\"$version\"></td>";

    print '</tr>';

    print '<tr>';

    print '<td valign=top class="even">' . _MD_A_GOINGTEXT . '</td>';

    print '<td class="odd">' . _MD_A_GOINGTEXTDESC . "<br><input type=\"text\" name=\"goingtextn\" value=\"$goingtext\"></td>";

    print '</tr>';

    print '<tr>';

    print '<td valign=top class="even">' . _MD_A_GOINGSELECT . '</td>';

    print '<td class="odd">' . _MD_A_GOINGSELECTDESC . "<br><input type=\"text\" name=\"goingselectn\" value=\"$goingselect\"></td>";

    print '</tr>';

    print '<tr>';

    print '<td valign=top class="even">' . _MD_A_NOTGOINGSELECT . '</td>';

    print '<td class="odd">' . _MD_A_NOTGOINGSELECTDESC . "<br><input type=\"text\" name=\"notgoingselectn\" value=\"$notgoingselect\"></td>";

    print '</tr>';

    print '<tr>';

    print '<td valign=top class="even">' . _MD_A_GOINGWELCOME . '</td>';

    print '<td class="odd">' . _MD_A_GOINGWELCOMEDESC . "<br><input type=\"text\" name=\"goingokn\" value=\"$goingok\"></td>";

    print '</tr>';

    print '<tr>';

    print '<td valign=top class="even">' . _MD_A_NOTGOINGWELCOME . '</td>';

    print '<td class="odd">' . _MD_A_NOTGOINGWELCOMEDESC . "<br><input type=\"text\" name=\"notgoingokn\" value=\"$notgoingok\"></td>";

    print '</tr>';

    print '<tr>';

    print '<td valign=top class="even">' . _MD_A_EVENTDATE . '</td>';

    print '<td class="odd">' . _MD_A_EVENTDATEDESC . "<br><input type=\"text\" name=\"eventdaten\" value=\"$eventdate\"></td>";

    print '</tr>';

    print '<tr>';

    print '<td valign=top class="even">' . _MD_A_LOCATION . '</td>';

    print '<td class="odd">' . _MD_A_LOCATIONDESC . "<br><textarea name=\"locationn\" cols=\"50\" rows=\"10\">$location</textarea></td>";

    print '</tr>';

    print '<tr>';

    print '<td valign=top class="even">' . _MD_A_DETAILS . '</td>';

    print '<td class="odd">' . _MD_A_DETAILSDESC . "<br><textarea name=\"detailsn\" cols=\"50\" rows=\"10\">$details</textarea></td>";

    print '</tr>';

    print '<tr>';

    print '<td valign=top class="even">' . _MD_A_GAMES . '</td>';

    print '<td class="odd">' . _MD_A_GAMESDESC . "<br><input type=\"text\" name=\"gamesn\" size=\"50\" value=\"$games\"></td>";

    print '</tr>';

    print '<tr>';

    print '<td valign=top class="even">' . _MD_A_REQUIRMENTS . '</td>';

    print '<td class="odd">' . _MD_A_REQUIRMENTSDESC . "<br><textarea name=\"requirmentsn\" cols=\"50\" rows=\"10\">$requirments</textarea></td>";

    print '</tr>';

    print '<tr>';

    print '<td valign=top class="even">' . _MD_A_RULES . '</td>';

    print '<td class="odd">' . _MD_A_RULESDESC . "<br><textarea name=\"rulesn\" cols=\"50\" rows=\"10\">$rules</textarea></td>";

    print '</tr>';

    print '<tr>';

    print '<td valign=top class="even">' . _MD_A_SUGGESTIONS . '</td>';

    print '<td class="odd">' . _MD_A_SUGGESTIONSDESC . "<br><textarea name=\"suggestionsn\" cols=\"50\" rows=\"10\">$suggestions</textarea></td>";

    print '</tr>';

    print '<tr>';

    print '<td valign=top class="even">' . _MD_A_CONTACTEMAIL . '</td>';

    print '<td class="odd">' . _MD_A_CONTACTEMAILDESC . "<br><input type=\"text\" name=\"adminemailn\" value=\"$adminemail\"></td>";

    print '</tr>';

    print '<tr>';

    print '<td valign=top class="even">' . _MD_A_UPDATE . '</td>';

    print '<td class="odd"><input type="Submit" name="Submit" value="' . _MD_A_BUPDATE . '"></td>';

    print '</tr>';

    print '<td valign=top class="even">' . $_POST['versionn'] . '</td>';

    print '</form>';

    CloseTable();

    print '<br>';

    OpenTable();

    $query = 'select * from ' . $xoopsDB->prefix('lan_spons');

    $sresult = $xoopsDB->query($query) or die(_MD_ERRORINQU . " $query. " . $xoopsDB->error());

    print '<tr>';

    print '<td valign=top class="even">' . _MD_A_WARNING . '</td>';

    print '<td class="odd">' . _MD_A_WARNINGDESC . '</td>';

    print '</tr>';

    while (false !== ($srow = $xoopsDB->fetchRow($sresult))) {
        print '<tr>';

        print "<td valign=top class=\"even\">$srow[1] - $srow[2]</td>";

        print "<td class=\"odd\"><a href=index.php?op=lan&remove=$srow[0]>" . _DELETE . "</a> - <a href=index.php?op=lan&edit=$srow[0]>" . _EDIT . '</a></td>';

        print '</tr>';
    }

    CloseTable();

    print '<br>';

    OpenTable();

    print '<form action="" method="POST">';

    print '<tr>';

    print '<th valign=top colspan=2>' . _MD_A_ADDSPONSBANNER . '</th>';

    print '</tr>';

    print '<tr>';

    print '<td valign=top class="even">' . _MD_A_SPONSNAME . '</td>';

    print "<td valign=top class=\"odd\"><input type=\"text\" name=\"namen\" value=\"$name\"></td>";

    print '</tr>';

    print '<tr>';

    print '<td valign=top class="even">' . _MD_A_SPONSURL . '</td>';

    print "<td valign=top class=\"odd\"><input type=\"text\" name=\"bannerurln\" value=\"$bannerurl\"></td>";

    print '</tr>';

    print '<tr>';

    print '<td valign=top class="even">' . _MD_A_CLICKTHRU . '</td>';

    print "<td valign=top class=\"odd\"><input type=\"text\" name=\"linkurln\" value=\"$linkurl\"></td>";

    print '</tr>';

    print '<tr>';

    print '<td valign=top class="even">' . _MD_A_TEXTBANNER . '</td>';

    print "<td class=\"odd\"><textarea name=\"bannertextn\" cols=\"50\" rows=\"10\">$bannertext</textarea></td>";

    print '</tr>';

    print '<tr>';

    print '<td valign=top class="even">' . _MD_A_SUBMIT . '</td>';

    print '<td class="odd"><input type="submit" name="Submit" value="' . _MD_A_BADDSPONS . '"></td>';

    print '</tr>';

    CloseTable();

    print '<br>';

    OpenTable();

    print '<form action="" method="POST">';

    print '<tr>';

    print '<td valign=top class="even">' . _MD_A_EMPTYLIST . '</td>';

    print '<td valign=top class="odd">' . _MD_A_EMPTYLISTDESC . '</td>';

    print '</tr>';

    print '<tr>';

    print '<td valign=top class="even">' . _MD_A_SUBMIT . '</td>';

    print '<td valign=top class="odd"><input type="submit" name="Submit" value="' . _MD_A_BEMPTYLIST . '"></td>';

    print '</tr>';

    CloseTable();

    print '<br>';

    OpenTable();

    $result = $xoopsDB->query('select * from ' . $xoopsDB->prefix('lan_blockinfo'));

    $info = $xoopsDB->fetchRow($result);

    print '<form action="" method="POST">';

    print '<tr>';

    print '<td valign=top class="even">' . _MD_A_MANBLOCKINFO . '</td>';

    print '<td valign=top class="odd">' . _MD_A_CURRENTINFO . '</td>';

    print '</tr>';

    print '<tr>';

    print '<td valign=top class="even">' . _DATE . '</td>';

    print "<td valign=top class=\"odd\"><input type=\"text\" name=\"daten\" value=\"$info[1]\"></td>";

    print '</tr>';

    print '<tr>';

    print '<td valign=top class="even">' . _MD_A_STATUS . '</td>';

    print '<td class="odd">' . _MD_A_STATUSDESC . '<br><select name ="statusn" rows=1><option value="' . _MD_A_OPEN . '" ';

    if (_MD_A_OPEN == $info[2]) {
        echo 'selected';
    }

    print '>open</option><option value="' . _MD_A_CLOSED . '" ';

    if (_MD_A_CLOSED == $info[2]) {
        echo 'selected';
    }

    print '>closed</option></select></td>';

    print '</tr>';

    print '<tr>';

    print '<td class="even">' . _MD_A_SUBMIT . '</td>';

    print '<td class="odd"><input type="submit" name="Submit" value="' . _MD_A_BUPDATEBLOCK . '"></td>';

    print '</tr>';

    CloseTable();

    print '<br>';

    xoops_cp_footer();
}

switch ($op) {
    case 'update':
        lanupdate();
        break;
    case 'Submit':
        lanupdate();
        break;
    case 'lanmain':

    default:
        lanmain();
        break;
}
