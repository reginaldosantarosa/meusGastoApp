<?php

use App\Services\PagSeguro\Subscription\SubscriptionReaderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/notificacoes', function(Request $request) {


    $data = $request->only('notificationType', 'notificationCode');

    $subscription = (new SubscriptionReaderService())
        ->getSubscriptionByNotificationCode($data['notificationCode']);

    dd($subscription);

    if(isset($subscription['error']) && $subscription['error'])
        return response()->json(['data' => ['msg' => 'Nada encontrado jjj!']], 404);

    $userPlano = \App\Models\UserPlano::whereReferenciaTransacao($subscription['code'])->first();

    if(!$userPlano) return response()->json(['data' => ['msg' => 'Nada encontrado!']], 404);

    $userPlano->update(['status' => $subscription['status']]);

    if($subscription['status'] == 'ACTIVE') {
        //Enviar um e-mail pro usuário agradecendo a adesão...
    }

    if($subscription['status'] == 'CANCELLED') {
        //Enviar um e-mail pro usuário pedindo desculpas mas não foi possivel renovar o plano...
    }

    return response()->json([], 204);
});
