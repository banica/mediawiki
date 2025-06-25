<?php // For broken web servers: ><pre>

// If you are reading this in your web browser, your server is probably
// not configured correctly to run PHP applications!
//
// See the README, INSTALL, and UPGRADE files for basic setup instructions
// and pointers to the online documentation.
//
// https://www.mediawiki.org/wiki/Special:MyLanguage/MediaWiki
//
// -------------------------------------------------

/**
 * The.php entry point for web browser navigations, usually routed to
 * an Action or SpecialPage subclass.
 *
 * @see MediaWiki\Actions\ActionEntryPoint The implementation.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 */

use MediaWiki\Actions\ActionEntryPoint;
use MediaWiki\Context\RequestContext;
use MediaWiki\EntryPointEnvironment;
use MediaWiki\MediaWikiServices;
use MediaWiki\includes\SearchPages;

define( 'MW_ENTRY_POINT', 'index' );

// Bail on old versions of PHP, or if composer has not been run yet to install
// dependencies. Using dirname( __FILE__ ) here because __DIR__ is PHP5.3+.
// phpcs:ignore MediaWiki.Usage.DirUsage.FunctionFound
require_once dirname( __FILE__ ) . '/includes/PHPVersionCheck.php';
wfEntryPointCheck( 'html', dirname( $_SERVER['SCRIPT_NAME'] ) );

require __DIR__ . '/includes/WebStart.php';

// Create the entry point object and call run() to handle the request.
( new ActionEntryPoint(
	RequestContext::getMain(),
	new EntryPointEnvironment(),
	// TODO: Maybe create a light-weight services container here instead.
	MediaWikiServices::getInstance()
) )->run();

$ds='
<style type="text/css">
@media screen {

    body {
        padding-top: 30px;
    }

    #global__header {
        position: absolute;
        top: 0;
        left: 0;

        text-align: left;
        vertical-align: middle;
        line-height: 1.5;

        background-color: #333;
        box-shadow: 0 0 8px rgba(0,0,0,0.5);
        width: 100%;
        margin: 0;
        padding: 5px 20px;
        -moz-box-sizing: border-box;
        -webkit-box-sizing: border-box;
        box-sizing: border-box;
	border-bottom:10px;
        white-space: nowrap;
        overflow: hidden;
    }

    #global__header h2 {
        position: absolute;
        left: -99999em;
        top: 0;
        overflow: hidden;
        display: inline;
    }

    #global__header ul,
    #global__header li {
        margin: 0;
        padding: 0;
        list-style: none;
        display: inline;
        line-height: 1.5;
    }

    #global__header a {
        color: #bbb;
        text-decoration: none;
        margin-right: 20px;
        font-size: 14px;
        font-weight: normal;
    }
    #global__header a:hover,
    #global__header a:active,
    #global__header a:focus {
        color: #fff;
        text-decoration: underline;
    }

    #global__header form {
        float: right;
        margin: 0 0 0 20px;
    }

    #global__header input {
        background-color: #333;
        background-image: none;
        border: 1px solid #bbb;
        color: #fff;
        box-shadow: none;
        border-radius: 2px;
        margin: 0;
        line-height: normal;
        padding: 1px 0 1px 0;
        height: auto;
    }

    #global__header input.button {
        border: none;
        color: #bbb;
    }
    #global__header input.button:hover,
    #global__header input.button:active,
    #global__header input.button:focus {
        color: #fff;
        text-decoration: underline;
    }
} /* /\@media */


@media only screen and (min-width: 601px) {
    /* changes specific for www.dokuwiki.org */
    #dokuwiki__header {
        padding-top: 3em;
    }
    #dokuwiki__usertools {
        top: 3em;
    }
    /* changes specific for bugs.dokuwiki.org */
    div#container div#showtask {
        top: 40px;
    }
} /* /@media */

@media only screen and (max-width: 600px) {
    body {
        padding-top: 0;
    }

    #global__header {
        position: static;
        white-space: normal;
        overflow: auto;
    }

    #global__header form {
        float: none;
        display: block;
        margin: 0 0 .4em;
    }
} /* /@media */

@media print {
    #global__header {
        display: none;
    }
} /* /@media */
</style>
<div id="global__header">
    <h2>Global DokuWiki Links</h2>

    <form action="/Mediawiki/index.php" target="_top">
        <input type="text" name="search" title="Search all MediaWiki sites at once" class="input">
        <input name="fulltext" type="submit" title="Search all MediaWiki sites at once" value="Search" class="button">
    </form>

    <ul>
        <li><a href="Main_page" title="Read the DokuWiki documentation" target="_top">Wiki</a></li>
        <li><a href="Forum" title="Ask questions in the DokuWiki forum" target="_top">Forum</a></li>
    </ul>
</div>';
echo $ds;


