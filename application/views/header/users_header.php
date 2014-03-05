<table border="1" width=80%" cellpadding="0" cellspacing="0" class="table">
    <tr>
        <td align="right" class="border-less" style="background-color:#FFF5EE; font-family: sans-serif;font-size: 10px;font-weight:bold;">
        <a href="<?php echo base_url();?>index.php/users_controller/change_password">UPDATE PASSWORD</a> -
        <a href="<?php echo base_url();?>index.php/users_controller/update_profile">UPDATE PROFILE</a>
        <?php
        if ($user_information['role_id'] == "2")
        {
             echo ' - <a href="'.base_url().'index.php/users_controller/add_user">ADD USERS</a>';
        }
        ?>
        </td>
    </tr>
</table>