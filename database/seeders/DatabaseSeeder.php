<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Material;
use App\Models\Product;
use App\Models\Category;
use App\Models\Recipe;
use App\Models\RecipeIngredient;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\MaterialHistory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Bikin User Admin
        $admin = User::create([
            'name' => 'Admin Alva Cake',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin123'),
        ]);

        // 2. Bikin Dummy Bahan Baku
        $terigu = Material::create(['name' => 'Tepung Terigu', 'unit' => 'kg', 'stock' => 100, 'min_stock' => 10]);
        $gula = Material::create(['name' => 'Gula Pasir', 'unit' => 'kg', 'stock' => 50, 'min_stock' => 5]);
        $coklat = Material::create(['name' => 'Coklat Bubuk', 'unit' => 'gram', 'stock' => 10000, 'min_stock' => 1000]);
        $mentega = Material::create(['name' => 'Mentega Butter', 'unit' => 'kg', 'stock' => 40, 'min_stock' => 4]);
        $telur = Material::create(['name' => 'Telur Ayam', 'unit' => 'butir', 'stock' => 500, 'min_stock' => 50]);
        $susu = Material::create(['name' => 'Susu Cair', 'unit' => 'liter', 'stock' => 30, 'min_stock' => 5]);
        $keju = Material::create(['name' => 'Keju Cheddar', 'unit' => 'kg', 'stock' => 15, 'min_stock' => 2]);
        $pandan = Material::create(['name' => 'Pandan Paste', 'unit' => 'botol', 'stock' => 10, 'min_stock' => 1]);
        $whipcream = Material::create(['name' => 'Whip Cream', 'unit' => 'liter', 'stock' => 20, 'min_stock' => 3]);

        // 3. Pastikan Kategori Default Ada di DB
        $categoryNames = ['Lapis Legit', 'Black Forest', 'Brownies', 'Bolu Jadoel', 'Dessert Box'];
        $categories = [];
        foreach ($categoryNames as $name) {
            $categories[$name] = Category::firstOrCreate(['name' => $name]);
        }

        // 4. Data Produk Lengkap dan Bervariasi
        $productsData = [
            // Lapis Legit
            [
                'name' => 'Lapis Legit Original',
                'category_name' => 'Lapis Legit',
                'price' => 250000,
                'stock' => 15,
                'status' => 'aktif',
                'description' => 'Lapis Legit klasik premium dengan aroma bumbu spekuk yang harum dan tekstur super lembut.'
            ],
            [
                'name' => 'Lapis Legit Keju',
                'category_name' => 'Lapis Legit',
                'price' => 280000,
                'stock' => 10,
                'status' => 'aktif',
                'description' => 'Lapis Legit premium dengan parutan keju cheddar berkualitas di setiap lapisannya.'
            ],
            [
                'name' => 'Lapis Legit Prunes',
                'category_name' => 'Lapis Legit',
                'price' => 320000,
                'stock' => 8,
                'status' => 'aktif',
                'description' => 'Lapis Legit premium dengan potongan buah prunes (plum kering) asam-manis segar.'
            ],
            [
                'name' => 'Lapis Legit Pandan',
                'category_name' => 'Lapis Legit',
                'price' => 260000,
                'stock' => 12,
                'status' => 'aktif',
                'description' => 'Lapis Legit dengan aroma pandan segar alami dari perasan daun suji dan pandan asli.'
            ],
            [
                'name' => 'Lapis Legit Almond',
                'category_name' => 'Lapis Legit',
                'price' => 290000,
                'stock' => 7,
                'status' => 'aktif',
                'description' => 'Lapis Legit premium yang ditaburi irisan kacang almond renyah di bagian atasnya.'
            ],

            // Black Forest
            [
                'name' => 'Black Forest Classic',
                'category_name' => 'Black Forest',
                'price' => 180000,
                'stock' => 20,
                'status' => 'aktif',
                'description' => 'Kue coklat spons lembut khas Jerman dengan lapisan krim kocok, buah ceri hitam, dan parutan coklat melimpah.'
            ],
            [
                'name' => 'Premium Black Forest Fudge',
                'category_name' => 'Black Forest',
                'price' => 240000,
                'stock' => 10,
                'status' => 'aktif',
                'description' => 'Kombinasi brownies fudge coklat pekat dengan dark cherry premium dan chocolate ganache.'
            ],
            [
                'name' => 'White Forest Cake',
                'category_name' => 'Black Forest',
                'price' => 175000,
                'stock' => 12,
                'status' => 'aktif',
                'description' => 'Kue bolu vanila lembut dengan krim segar, buah ceri merah manis, dan taburan coklat putih serut.'
            ],
            [
                'name' => 'Black Forest Roll',
                'category_name' => 'Black Forest',
                'price' => 95000,
                'stock' => 15,
                'status' => 'aktif',
                'description' => 'Bolu gulung coklat dengan krim mentega ceri hitam, dibalut coklat serut melimpah.'
            ],

            // Brownies
            [
                'name' => 'Brownies Coklat Lumer',
                'category_name' => 'Brownies',
                'price' => 75000,
                'stock' => 25,
                'status' => 'aktif',
                'description' => 'Brownies panggang super fudgy dengan siraman coklat ganache premium yang lumer di mulut.'
            ],
            [
                'name' => 'Brownies Panggang Almond',
                'category_name' => 'Brownies',
                'price' => 68000,
                'stock' => 30,
                'status' => 'aktif',
                'description' => 'Brownies panggang renyah di luar, chewy di dalam, dengan taburan kacang almond panggang melimpah.'
            ],
            [
                'name' => 'Brownies Kukus Keju',
                'category_name' => 'Brownies',
                'price' => 65000,
                'stock' => 18,
                'status' => 'aktif',
                'description' => 'Brownies kukus coklat lembut berpadu dengan lapisan cream cheese gurih di tengahnya.'
            ],
            [
                'name' => 'Matcha Almond Brownies',
                'category_name' => 'Brownies',
                'price' => 80000,
                'stock' => 15,
                'status' => 'aktif',
                'description' => 'Brownies premium dengan bubuk Uji Matcha Jepang asli dan white chocolate chips.'
            ],
            [
                'name' => 'Brownies Sekat Premium',
                'category_name' => 'Brownies',
                'price' => 85000,
                'stock' => 22,
                'status' => 'aktif',
                'description' => 'Brownies sekat isi 25 potong dengan 5 macam topping: Keju, Almond, Chocochips, Oreo, & Beng-Beng.'
            ],

            // Bolu Jadoel
            [
                'name' => 'Bolu Tape Keju Singkong',
                'category_name' => 'Bolu Jadoel',
                'price' => 55000,
                'stock' => 20,
                'status' => 'aktif',
                'description' => 'Bolu tape singkong tradisional yang wangi, lembut, bertabur keju parut melimpah.'
            ],
            [
                'name' => 'Bolu Macan Bangka',
                'category_name' => 'Bolu Jadoel',
                'price' => 70000,
                'stock' => 15,
                'status' => 'aktif',
                'description' => 'Butter cake premium dengan motif marmer macan khas Bangka yang super lembut dan wangi mentega.'
            ],
            [
                'name' => 'Bolu Chiffon Pandan Santan',
                'category_name' => 'Bolu Jadoel',
                'price' => 60000,
                'stock' => 18,
                'status' => 'aktif',
                'description' => 'Chiffon cake super membal dan lembut dengan aroma perasan daun pandan murni dan santan segar.'
            ],
            [
                'name' => 'Bolu Gulung Selai Nanas',
                'category_name' => 'Bolu Jadoel',
                'price' => 50000,
                'stock' => 25,
                'status' => 'aktif',
                'description' => 'Bolu gulung lembut tradisional dengan isian selai nanas buatan sendiri yang asam manis segar.'
            ],
            [
                'name' => 'Bolu Gulung Keju Meses',
                'category_name' => 'Bolu Jadoel',
                'price' => 58000,
                'stock' => 20,
                'status' => 'aktif',
                'description' => 'Bolu gulung klasik dengan buttercream premium, keju cheddar parut, dan meses coklat.'
            ],

            // Dessert Box
            [
                'name' => 'Dessert Box Turkish Choco',
                'category_name' => 'Dessert Box',
                'price' => 45000,
                'stock' => 35,
                'status' => 'aktif',
                'description' => 'Dessert box premium dengan lapisan cake coklat, mousse belgian chocolate, dan siraman chocolate ganache kental.'
            ],
            [
                'name' => 'Dessert Box Red Velvet Cheese',
                'category_name' => 'Dessert Box',
                'price' => 48000,
                'stock' => 30,
                'status' => 'aktif',
                'description' => 'Dessert box dengan remah red velvet gurih manis berpadu krim keju mascarpone yang lumer.'
            ],
            [
                'name' => 'Dessert Box Lotus Biscoff',
                'category_name' => 'Dessert Box',
                'price' => 50000,
                'stock' => 25,
                'status' => 'aktif',
                'description' => 'Dessert box kekinian dengan biskuit Lotus renyah, selai Lotus Biscoff melimpah, dan krim lembut.'
            ],
            [
                'name' => 'Dessert Box Classic Tiramisu',
                'category_name' => 'Dessert Box',
                'price' => 46000,
                'stock' => 28,
                'status' => 'aktif',
                'description' => 'Dessert box ala Italia dengan ladyfinger yang direndam espresso premium dan krim mascarpone gurih.'
            ],
            [
                'name' => 'Dessert Box Cadbury Oreo',
                'category_name' => 'Dessert Box',
                'price' => 47000,
                'stock' => 32,
                'status' => 'aktif',
                'description' => 'Perpaduan renyah remah biskuit Oreo, mousse putih susu, dan potongan coklat Cadbury premium.'
            ],
        ];

        foreach ($productsData as $pData) {
            $catName = $pData['category_name'];
            $catId = isset($categories[$catName]) ? $categories[$catName]->id : null;

            Product::create([
                'user_id' => $admin->id,
                'name' => $pData['name'],
                'category' => $catName,
                'category_id' => $catId,
                'price' => $pData['price'],
                'stock' => $pData['stock'],
                'status' => $pData['status'],
                'description' => $pData['description'],
            ]);
        }

        // Ambil data produk untuk dihubungkan
        $prd_brownies = Product::where('name', 'Brownies Coklat Lumer')->first();
        $prd_lapis = Product::where('name', 'Lapis Legit Original')->first();
        $prd_bf_classic = Product::where('name', 'Black Forest Classic')->first();
        $prd_bf_roll = Product::where('name', 'Black Forest Roll')->first();
        $prd_red_velvet = Product::where('name', 'Dessert Box Red Velvet Cheese')->first();
        $prd_lotus = Product::where('name', 'Dessert Box Lotus Biscoff')->first();
        $prd_chiffon = Product::where('name', 'Bolu Chiffon Pandan Santan')->first();

        // 5. Bikin Dummy Resep & Bahan untuk Brownies Coklat Lumer
        $recipeBrownies = Recipe::create([
            'product_id' => $prd_brownies->id
        ]);

        RecipeIngredient::create([
            'recipe_id' => $recipeBrownies->id,
            'name' => 'Tepung Terigu',
            'qty' => 0.4,
            'unit' => 'kg'
        ]);

        RecipeIngredient::create([
            'recipe_id' => $recipeBrownies->id,
            'name' => 'Gula Pasir',
            'qty' => 0.25,
            'unit' => 'kg'
        ]);

        RecipeIngredient::create([
            'recipe_id' => $recipeBrownies->id,
            'name' => 'Coklat Bubuk',
            'qty' => 150,
            'unit' => 'gram'
        ]);

        RecipeIngredient::create([
            'recipe_id' => $recipeBrownies->id,
            'name' => 'Mentega Butter',
            'qty' => 0.2,
            'unit' => 'kg'
        ]);

        RecipeIngredient::create([
            'recipe_id' => $recipeBrownies->id,
            'name' => 'Telur Ayam',
            'qty' => 4,
            'unit' => 'butir'
        ]);

        // 6. Bikin Dummy Resep & Bahan untuk Lapis Legit Original
        $recipeLapis = Recipe::create([
            'product_id' => $prd_lapis->id
        ]);

        RecipeIngredient::create([
            'recipe_id' => $recipeLapis->id,
            'name' => 'Mentega Butter',
            'qty' => 0.5,
            'unit' => 'kg'
        ]);

        RecipeIngredient::create([
            'recipe_id' => $recipeLapis->id,
            'name' => 'Gula Pasir',
            'qty' => 0.3,
            'unit' => 'kg'
        ]);

        RecipeIngredient::create([
            'recipe_id' => $recipeLapis->id,
            'name' => 'Telur Ayam',
            'qty' => 30,
            'unit' => 'butir'
        ]);

        RecipeIngredient::create([
            'recipe_id' => $recipeLapis->id,
            'name' => 'Tepung Terigu',
            'qty' => 0.1,
            'unit' => 'kg'
        ]);

        // 7. Bikin Dummy Resep & Bahan untuk Black Forest Classic
        $recipeBF = Recipe::create([
            'product_id' => $prd_bf_classic->id
        ]);

        RecipeIngredient::create([
            'recipe_id' => $recipeBF->id,
            'name' => 'Tepung Terigu',
            'qty' => 0.2,
            'unit' => 'kg'
        ]);

        RecipeIngredient::create([
            'recipe_id' => $recipeBF->id,
            'name' => 'Gula Pasir',
            'qty' => 0.2,
            'unit' => 'kg'
        ]);

        RecipeIngredient::create([
            'recipe_id' => $recipeBF->id,
            'name' => 'Telur Ayam',
            'qty' => 8,
            'unit' => 'butir'
        ]);

        RecipeIngredient::create([
            'recipe_id' => $recipeBF->id,
            'name' => 'Coklat Bubuk',
            'qty' => 50,
            'unit' => 'gram'
        ]);

        RecipeIngredient::create([
            'recipe_id' => $recipeBF->id,
            'name' => 'Whip Cream',
            'qty' => 0.5,
            'unit' => 'liter'
        ]);

        // 8. Bikin Dummy Pesanan (Orders)
        $today = date('Y-m-d');
        $yesterday = date('Y-m-d', strtotime('-1 day'));
        $twoDaysAgo = date('Y-m-d', strtotime('-2 days'));
        $fiveDaysAgo = date('Y-m-d', strtotime('-5 days'));

        $order1 = Order::create([
            'customer' => 'Budi Santoso',
            'phone' => '081234567890',
            'status' => 'Pending',
            'order_date' => $today,
            'finish_date' => date('Y-m-d', strtotime($today . ' + 2 days')),
            'notes' => 'Minta topping coklat ganache-nya agak tebal ya kak. Terima kasih!',
            'total' => 225000,
        ]);
        $order1->productsRelation()->attach($prd_brownies->id, [
            'qty' => 3,
            'price' => $prd_brownies->price,
            'subtotal' => 3 * $prd_brownies->price
        ]);

        $order2 = Order::create([
            'customer' => 'Siti Rahma',
            'phone' => '082345678901',
            'status' => 'Diproses',
            'order_date' => $yesterday,
            'finish_date' => date('Y-m-d', strtotime($yesterday . ' + 3 days')),
            'notes' => 'Untuk arisan keluarga besar hari minggu sore.',
            'total' => 500000,
        ]);
        $order2->productsRelation()->attach($prd_lapis->id, [
            'qty' => 2,
            'price' => $prd_lapis->price,
            'subtotal' => 2 * $prd_lapis->price
        ]);

        $order3 = Order::create([
            'customer' => 'Rian Hidayat',
            'phone' => '083456789012',
            'status' => 'Selesai',
            'order_date' => $fiveDaysAgo,
            'finish_date' => date('Y-m-d', strtotime($fiveDaysAgo . ' + 2 days')),
            'notes' => 'Tulis ucapan "Happy Birthday Ayah" warna merah muda di atas kue.',
            'total' => 275000,
        ]);
        $order3->productsRelation()->attach($prd_bf_classic->id, [
            'qty' => 1,
            'price' => $prd_bf_classic->price,
            'subtotal' => $prd_bf_classic->price
        ]);
        $order3->productsRelation()->attach($prd_bf_roll->id, [
            'qty' => 1,
            'price' => $prd_bf_roll->price,
            'subtotal' => $prd_bf_roll->price
        ]);

        $order4 = Order::create([
            'customer' => 'Dewi Lestari',
            'phone' => '084567890123',
            'status' => 'Dibatalkan',
            'order_date' => $twoDaysAgo,
            'finish_date' => date('Y-m-d', strtotime($twoDaysAgo . ' + 2 days')),
            'notes' => 'Batal dipesan karena acara mendadak diundur.',
            'total' => 96000,
        ]);
        $order4->productsRelation()->attach($prd_red_velvet->id, [
            'qty' => 2,
            'price' => $prd_red_velvet->price,
            'subtotal' => 2 * $prd_red_velvet->price
        ]);

        $order5 = Order::create([
            'customer' => 'Agus Pratama',
            'phone' => '085678901234',
            'status' => 'Diproses',
            'order_date' => $today,
            'finish_date' => date('Y-m-d', strtotime($today . ' + 2 days')),
            'notes' => 'Tolong di-packing per kotak rapi untuk oleh-oleh.',
            'total' => 220000,
        ]);
        $order5->productsRelation()->attach($prd_lotus->id, [
            'qty' => 2,
            'price' => $prd_lotus->price,
            'subtotal' => 2 * $prd_lotus->price
        ]);
        $order5->productsRelation()->attach($prd_chiffon->id, [
            'qty' => 2,
            'price' => $prd_chiffon->price,
            'subtotal' => 2 * $prd_chiffon->price
        ]);

        // 9. Bikin Dummy Riwayat Transaksi (Transactions)
        Transaction::create([
            'order_id' => $order3->id,
            'customer' => 'Rian Hidayat',
            'admin' => 'Admin Alva Cake',
            'type' => 'Lunas',
            'status' => 'Lunas',
            'paid' => 275000,
            'total' => 275000,
            'payment_date' => $fiveDaysAgo,
            'notes' => $order3->notes,
        ]);

        Transaction::create([
            'order_id' => $order2->id,
            'customer' => 'Siti Rahma',
            'admin' => 'Admin Alva Cake',
            'type' => 'DP',
            'status' => 'Belum Lunas',
            'paid' => 200000,
            'total' => 500000,
            'payment_date' => $yesterday,
            'dp_nota' => 'DP-001',
            'notes' => $order2->notes,
        ]);

        Transaction::create([
            'order_id' => $order5->id,
            'customer' => 'Agus Pratama',
            'admin' => 'Admin Alva Cake',
            'type' => 'Lunas',
            'status' => 'Lunas',
            'paid' => 220000,
            'total' => 220000,
            'payment_date' => $today,
            'notes' => $order5->notes,
        ]);

        // 10. Bikin Dummy Riwayat Bahan Baku (Material Histories)
        MaterialHistory::create([
            'material_id' => $terigu->id,
            'material_name' => $terigu->name,
            'type' => 'inbound',
            'qty' => 50,
            'notes' => 'Pengadaan awal bahan baku tepung terigu premium'
        ]);

        MaterialHistory::create([
            'material_id' => $gula->id,
            'material_name' => $gula->name,
            'type' => 'inbound',
            'qty' => 30,
            'notes' => 'Pembelian gula pasir bermerek di agen'
        ]);

        MaterialHistory::create([
            'material_id' => $mentega->id,
            'material_name' => $mentega->name,
            'type' => 'inbound',
            'qty' => 20,
            'notes' => 'Restock mentega butter wisman impor'
        ]);

        MaterialHistory::create([
            'material_id' => $terigu->id,
            'material_name' => $terigu->name,
            'type' => 'outbound',
            'qty' => 2.5,
            'notes' => 'Produksi 5 unit kue pesanan',
            'product_name' => 'Lapis Legit Original',
            'product_id' => $prd_lapis->id
        ]);

        MaterialHistory::create([
            'material_id' => $coklat->id,
            'material_name' => $coklat->name,
            'type' => 'outbound',
            'qty' => 450,
            'notes' => 'Produksi 3 unit brownies coklat lumer',
            'product_name' => 'Brownies Coklat Lumer',
            'product_id' => $prd_brownies->id
        ]);
    }
}
