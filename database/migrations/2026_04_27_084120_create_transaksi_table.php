    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        public function up(): void
        {
            Schema::create('transaksi', function (Blueprint $table) {
                $table->id('id_transaksi');
                $table->foreignId('id_tiket')->constrained('tiket', 'id_tiket')->onDelete('cascade');
                $table->string('metode_bayar', 30);
                $table->decimal('total_bayar', 10, 2);
                $table->datetime('tgl_transaksi');
                $table->enum('status_bayar', ['Pending', 'Lunas', 'Gagal'])->default('Pending');
                $table->timestamps();
            });
        }

        public function down(): void
        {
            Schema::dropIfExists('transaksi');
        }
    };