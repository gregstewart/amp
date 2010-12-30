::/<?php if (isset($section_title)) {echo($section_title);} ?> content
            <!-- col 1 current content /2 = spacer / 3 archived content  -->
            <table border="0" cellpadding="0" cellspacing="0">
             <tr><td colspan="3"><img src="images/s.gif" width="10" height="15" alt="spacer" border="0" /></td></tr>
             <tr>
              <td class="normb" width="45%">Current content</td>
              <td><img src="images/s.gif" width="20" height="1" alt="spacer" border="0" /></td>
              <td class="normb" width="45%">Archived content</td>
             </tr>
             <tr><td colspan="3"><img src="images/s.gif" width="10" height="5" alt="spacer" border="0" /></td></tr>
             <tr valign="top">
              <td class="norm"><hr /><div><strong>Version:</strong> <?php echo($curr_ver); ?></div>
               <div><?php echo($curr_title); ?></div>
               <div><?php echo($curr_teaser); ?></div>
               <div><?php echo($curr_body); ?></div>
               <div><?php echo($curr_pub_status); ?></div>
               <div><img src="images/s.gif" width="1" height="5" alt="spacer" border="0" /><br /><a href="<?php echo($http); ?>home.php" class="norm">back</a></div>
              </td>
              <td class="norm"><img src="images/s.gif" width="20" height="1" alt="spacer" border="0" /></td>
              <td class="norm"><?php echo($archived_content) ?></td>
             </tr>
            </table>