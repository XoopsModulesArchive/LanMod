<?php

declare(strict_types=1);

// $Id: comment_delete.php,v 1.1 2003/01/29 03:18:28 w4z004 Exp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <https://www.xoops.org>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //

function block_lan_show()
{
    global $xoopsDB, $xoopsUser;

    $block = [];

    $myts = MyTextSanitizer::getInstance();

    $result = $xoopsDB->query('select * from ' . $xoopsDB->prefix('lan_blockinfo'));

    $info = $xoopsDB->fetchRow($result);

    if ('closed' != $info[2]) {
        if (!$xoopsUser) {
            $content = '<br><strong><big>·</big></strong> <a href="' . XOOPS_URL . '/user.php">' . _MB_LANMOD_LOGIN . ' </a>';
        } else {
            $content = '<br><strong><big>·</big></strong> <a href="' . XOOPS_URL . '/modules/LanMod/index.php?regis=show">' . _MB_LANMOD_PREREGISTER . '</a>';
        }
    } else {
        $content = '<br><strong><big>·</big></strong> ' . _MB_LANMOD_REGISTRATION . (string)$info[2];
    }

    $block['info1'] = $info[1];

    $block['info2'] = $info[2];

    $block['content'] = $content;

    //language content

    $block['nextevent'] = _MB_LANMOD_NEXTEVENT;

    $block['registration'] = _MB_LANMOD_REGISTRATION;

    $block['details'] = _MB_LANMOD_DETAILS;

    $block['whoscomming'] = _MB_LANMOD_WHOSCOMMING;

    $block['sponsors'] = _MB_LANMOD_SPONSORS;

    return $block;
}
