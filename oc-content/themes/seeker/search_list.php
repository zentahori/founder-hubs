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

 <table border="0" cellspacing="0">
     <tbody>
        <?php $class = "even" ; ?>
        <?php while(osc_has_items()) { ?>
            <tr class="<?php echo $class; ?>">
                 <td class="text">
                     <h3><a href="<?php echo osc_item_url() ; ?>"><?php echo osc_item_title() ; ?></a></h3>
                     <p><?php echo osc_highlight( strip_tags( osc_item_description() ), 200 ) ; ?></p>
                 </td>
             </tr>
            <?php $class = ($class == 'even') ? 'odd' : 'even' ; ?>
        <?php } ?>
    </tbody>
</table>