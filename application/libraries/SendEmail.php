<?php
class SendEmail
{
    public function __construct()
    {

    }

    function sendEmail($from_email='', $from_name='', $email_to='', $email_to_name='', $reply_to_email='', $reply_to_name='', $subject='', $body='', $attachments='', $cc='')
    {
        date_default_timezone_set('Etc/UTC');

        $my_instance =& get_instance();
        $my_instance->load->library('email');

        $config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.gmail.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['priority'] = '1';
        $config['smtp_user']    = 'info@351face.com';
        $config['smtp_pass']    = 'bezrpqyropenuzjs';
		$config['smtp_user']    = 'do.not.reply.the.msg@gmail.com';
		$config['smtp_pass']    = 'zeyeoqtvjcofdael';
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html';

        $my_instance->email->initialize($config);

        $body = utf8_decode($body);
        $my_instance->email->set_priority(1);
        $my_instance->email->from($from_email, $from_name);//
        if($reply_to_email!='')$my_instance->email->reply_to($reply_to_email, $reply_to_name);
        $my_instance->email->to($email_to, $email_to_name);//
        $my_instance->email->subject($subject);
        if($cc!='')$my_instance->email->cc($cc);


        if($attachments!='')
        {
            $attachments = explode("&", $attachments);
            $cant = sizeof($attachments);

            if ($cant)
            {
                for ($i = 0; $i < $cant; next($attachments), $i++)
                {
                    $attachment = current($attachments);

                    $my_instance->email->attach($attachment);
                    $img_cid = $my_instance->email->attachment_cid($attachment);
                    $body = str_replace("img_cid_" . $i, $img_cid, $body);
                }
            }
        }

        $my_instance->email->message($body);

        if($my_instance->email->send())
        {
            return 'success';}
        else
            print $my_instance->email->print_debugger();

    }
}
?>
