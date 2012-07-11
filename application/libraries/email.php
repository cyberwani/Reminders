<?php

class Email {
	protected $transport;
	protected $email_settings;
	protected $mailer;

	public function __construct()
	{
		$this->email_settings = include('email.config');
		// use extract

		$this->transport = Swift_SmtpTransport::newInstance($this->email_settings['smtp'], $this->email_settings['smtp_port'], 'ssl')
				->setUsername($this->email_settings['username'])
				->setPassword($this->email_settings['password']);

		$this->mailer = Swift_Mailer::newInstance($this->transport);
	}

	public function send_reminder($message)
	{
		$message = Swift_Message::newInstance($message->title)
					->setFrom([$this->email_settings['username'] => 'Reminders.dev'])
					->setTo([$message->email => "{$message->first_name} {$message->last_name}"])
					->setSubject("Reminder: {$message->title}")
					->setBody($this->email_settings['reminder_template']($message), 'text/html');

		// Send the message
		$this->mailer->send($message);
	}

	public function send_signup_confirmation($user)
	{
		$message = Swift_Message::newInstance('Thanks for signing up to RemindMe')
					->setFrom([$this->email_settings['username'] => 'Reminders.dev'])
					->setTo([$user->email => "{$user->first_name} {$user->last_name}"])
					->setBody($this->email_settings['signup_template']($user), 'text/html');

		$this->mailer->send($message);
	}

	public function send_creds_reset($user, $temp_password)
	{
		$message = Swift_Message::newInstance('RemindMe Credentials Reset')
					->setFrom([$this->email_settings['username'] => 'Reminders.dev'])
					->setTo([$user->email => "{$user->first_name} {$user->last_name}"])
					->setBody($this->email_settings['creds_reset']($user, $temp_password), 'text/html');

		$this->mailer->send($message);
	}
}