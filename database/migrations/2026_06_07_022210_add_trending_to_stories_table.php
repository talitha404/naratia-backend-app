public function up()
{
    Schema::table('stories', function (Blueprint $table) {
        // Menambahkan kolom tanpa menghapus kolom yang sudah ada
        $table->boolean('is_trending')->default(0); 
    });
}