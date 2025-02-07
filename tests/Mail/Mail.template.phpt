<?php

/**
 * Test: Nette\Mail\Message with template.
 */

use Nette\Mail\Message;
use Nette\Templating\FileTemplate;
use Tester\Assert;


require __DIR__ . '/../bootstrap.php';

require __DIR__ . '/Mail.php';

$_SERVER['HTTP_HOST'] = 'localhost';

$mail = new Message;
$mail->addTo('Lady Jane <jane@example.com>');

$template = new FileTemplate;
$template->setFile(__DIR__ . '/files/template.phtml');
$template->registerFilter(new Nette\Latte\Engine);
$template->mail = $mail;
$mail->setHtmlBody($template, __DIR__ . '/files');

$mailer = new TestMailer();
$mailer->send($mail);

Assert::matchFile(__DIR__ . '/Mail.template.expect', TestMailer::$output);
