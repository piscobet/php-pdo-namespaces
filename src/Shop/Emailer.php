<?php

namespace Shop;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

class Emailer {
    private PHPMailer $mailer;

    public function __construct() {
        // Load environment variables
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();

        $this->mailer = new PHPMailer(true);
        $this->configureSMTP();
    }

    private function configureSMTP(): void {
        $this->mailer->isSMTP();
        $this->mailer->Host = $_ENV['SMTP_HOST'];
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = $_ENV['SMTP_USERNAME'];
        $this->mailer->Password = $_ENV['SMTP_PASSWORD'];
        $this->mailer->Port = $_ENV['SMTP_PORT'];
        $this->mailer->CharSet = 'UTF-8';
        $this->mailer->setFrom($_ENV['SMTP_FROM'], $_ENV['SMTP_FROM_NAME']);
    }

    public function sendCartDetails(string $to, Cart $cart): bool {
        try {
            $this->mailer->addAddress($to);
            $this->mailer->Subject = "Your Cart Details";
            $this->mailer->Body = $cart->getCartDetails();
            $this->mailer->send();
            return true;
        } catch (Exception $e) {
            echo "Email could not be sent. Error: {$this->mailer->ErrorInfo}\n";
            return false;
        }
    }
}
