    <?php

    use App\Http\Controllers\ProfileController;
    use Illuminate\Support\Facades\Route;
    use App\Http\Controllers\MusicalController;
    use App\Http\Controllers\SongController;
    use App\Http\Controllers\ActorController;
    use App\Http\Controllers\TicketController;
    use Illuminate\Http\Request;
    use App\Models\User;
    use Stripe\Stripe;

    Route::get('/check-key', function () {
        dd(env('STRIPE_SECRET'));
    });


    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/dashboard', function () {
        return redirect()->route('musicals.index');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        // --- Stripe Payment Routes ---

        // Show payment form
        // Show checkout form
        Route::get('/checkout/{musical}', function ($musical) {
            $musical = \App\Models\Musical::findOrFail($musical);
            return view('checkout', compact('musical')); // <-- use parent view, not component directly
        })->name('checkout');

        Route::post('/checkout/{musical}', function (Request $request, $musical) {
        $musical = \App\Models\Musical::findOrFail($musical);

        // Set Stripe API key
        Stripe::setApiKey(env('STRIPE_SECRET'));

        // Create Stripe charge
        $charge = \Stripe\Charge::create([
            'amount' => 1000, // amount in cents
            'currency' => 'eur',
            'source' => 'tok_visa', 
            'description' => 'Payment for musical: ' . $musical->title, // description with musical title
        ]);

        // --- Add Ticket for this user ---
        $ticket = \App\Models\Ticket::create([
            'user_id' => auth()->id(),       // link ticket to logged-in user
            'musical_id' => $musical->id,   // link ticket to the purchased musical
        ]);

        return redirect()
            ->route('tickets.index') // redirect to the user’s tickets page
            ->with('success', 'Payment successful! Your ticket for ' . $musical->title . ' has been added.'); // success message with musical title
            })->name('checkout.pay'); // Route name for processing payment
    });

    // Musical Routes
    Route::get('/musicals', [MusicalController::class, 'index'])->name('musicals.index');
    Route::get('/musicals/create', [MusicalController::class, 'create'])->name('musicals.create');
    Route::get('/musicals/{musical}', [MusicalController::class, 'show'])->name('musicals.show');
    Route::post('/musicals', [MusicalController::class, 'store'])->name('musicals.store');
    Route::get('/musicals/{musical}/edit', [MusicalController::class, 'edit'])->name('musicals.edit');
    Route::put('/musicals/{musical}', [MusicalController::class, 'update'])->name('musicals.update');
    Route::delete('/musicals/{musical}', [MusicalController::class, 'destroy'])->name('musicals.destroy');

    // Nested song routes
    Route::get('musicals/{musical}/songs/create', [SongController::class, 'create'])->name('songs.create');
    Route::post('musicals/{musical}/songs', [SongController::class, 'store'])->name('songs.store');

    // Resource routes for songs (index, edit, update, destroy, show)
    Route::resource('songs', SongController::class)->except(['create','store']);

    // Resource routes for actors
    Route::resource('actors', ActorController::class)->middleware('auth');

    // Resource routes for tickets
    Route::resource('tickets', TicketController::class)->middleware('auth');

    require __DIR__.'/auth.php';