<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

use Talal\LabelPrinter\Printer;
use Talal\LabelPrinter\Mode\Escp;
use Talal\LabelPrinter\Command;

class order extends Model
{
    use HasFactory, Sortable;

    protected $fillable = ['user_id', 'customer_id', 'order_nr', 'status', 'handed', 'problem', 'description', 'password', 'price'];

    public $sortable = ['user_id', 'customer_id', 'order_nr', 'status', 'problem', 'description', 'updated_at', 'created_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function getOrderNumber()
    {
        return str_pad($this->id, 8, "0", STR_PAD_LEFT);
    }

    public function printLabel($message)
    {
        $ip = '10.0.0.137';
        $port = 9100;
        $stream = stream_socket_client("tcp://{$ip}:{$port}", $errorNumber, $errorString);
        $printer = new Printer(new Escp($stream));
        $font = new Command\Font('helsinki', Command\Font::TYPE_OUTLINE);
        $printer->addCommand(new Command\CharStyle(Command\CharStyle::NORMAL));
        $printer->addCommand($font);
        $printer->addCommand(new Command\CharSize(46, $font));
        $printer->addCommand(new Command\Align(Command\Align::LEFT));
        $printer->addCommand(new Command\Text($message));
        $printer->addCommand(new Command\Cut(Command\Cut::FULL));
        $printer->printLabel();

        fclose($stream);
    }

}



