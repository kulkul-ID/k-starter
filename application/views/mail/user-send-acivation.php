<?php
    $CI = &get_instance();
    $CI->load->library('encrypt');
    $url = site_url('user/activate/'.urlencode(urlencode($CI->encrypt->encode($user->id))));
?>
<p>
Dear <?php echo $user->full_name ?>,
</p>

<p>
Please activate you account by following this url:<br />
<a href="<?php echo $url; ?>"><?php echo $url; ?></a>
</p>

<p>
Thank you,
</p>