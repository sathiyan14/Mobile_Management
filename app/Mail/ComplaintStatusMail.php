<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Services\QrService;

class ComplaintStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $status;
    public $complaint;
    public $qrUrl;
    public $qrSvg;

    /**
     * Create a new message instance.
     * 
     * @param $user - User model
     * @param $status - Status string (e.g., 'Ready', 'Delivered')
     * @param $complaint - Complaint model
     * @param $qrUrl - URL string to encode in QR code (or null)
     */
    public function __construct($user, $status, $complaint, $qrUrl = null)
    {
        $this->user = $user;
        $this->status = $status;
        $this->complaint = $complaint;
        $this->qrUrl = $qrUrl;
        
        // Generate SVG QR code if URL provided
        if ($qrUrl) {
            try {
                $this->qrSvg = QrService::forEmail($qrUrl);
            } catch (\Exception $e) {
                $this->qrSvg = null;
            }
        } else {
            $this->qrSvg = null;
        }
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Complaint Status Update - ' . $this->complaint->brand . ' ' . $this->complaint->model,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.complaint-status',
            with: [
                'user' => $this->user,
                'status' => $this->status,
                'complaint' => $this->complaint,
                'qrSvg' => $this->qrSvg,
            ]
        );
    }

    /**
     * No attachments - SVG is embedded directly in HTML
     */
    public function attachments(): array
    {
        return [];
    }
}


