<?php

namespace App\Mail;

use App\Models\Pasien;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class PengambilanStrukMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pasien;

    public function __construct(Pasien $pasien)
    {
        $this->pasien = $pasien;
    }

    public function build()
    {
        // pastikan email pasien ada
        if (empty($this->pasien->email)) {
            throw new \Exception("Email pasien tidak boleh kosong!");
        }

        // generate PDF dari view struk
        $pdf = Pdf::loadView('admin.rekamMedis_struk', [
            'pasien' => $this->pasien,
            'pengaturan' => [
                'alamat' => 'Jl. Contoh No.123, Jambi', // bisa diganti dari config
                'no_hp' => '08123456789',
                'email' => 'info@optikutama.com',
            ],
        ])->setPaper('a6', 'portrait');

        return $this->to($this->pasien->email) // <--- ini wajib
                    ->subject('Struk Pengambilan Kacamata')
                    ->view('emails.pengambilan')
                    ->attachData($pdf->output(), 'struk-'.$this->pasien->id.'.pdf', [
                        'mime' => 'application/pdf'
                    ]);
    }
}
