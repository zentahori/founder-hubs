<?php
    /*
     *      OSCLass – software for creating and publishing online classified
     *                           advertising platforms
     *
     *                        Copyright (C) 2013 Osclass
     *
     *       This program is free software: you can redistribute it and/or
     *     modify it under the terms of the GNU Affero General Public License
     *     as published by the Free Software Foundation, either version 3 of
     *            the License, or (at your option) any later version.
     *
     *     This program is distributed in the hope that it will be useful, but
     *         WITHOUT ANY WARRANTY; without even the implied warranty of
     *        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *             GNU Affero General Public License for more details.
     *
     *      You should have received a copy of the GNU Affero General Public
     * License along with this program.  If not, see <http://www.gnu.org/licenses/>.
     */
?>
<?php osc_show_widgets('footer'); ?>
<div id="footer">
    <div class="inner">
        <?php _e('This website is proudly using the classifieds scripts software <strong><a href="http://osclass.org/">Osclass</a></strong>', 'seeker'); ?>.
    </div>
</div>
</div> <!-- wrapper -->
</div> <!-- container -->

<?php osc_show_flash_message() ; ?>
<?php osc_run_hook('footer'); ?>
</body>
</html>