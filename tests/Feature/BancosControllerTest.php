<?php

namespace Tests\Feature;

use App\Models\Bancos;
use Illuminate\Http\Response;
use Tests\TestCase;

class BancosControllerTest extends TestCase
{
    /**
     * Test listing of banks with pagination.
     * This test sends a GET request to the '/api/bancos' route with the 'perPage=30' parameter.
     * It checks if the response status is HTTP 200 and if the JSON structure contains 'data' with fields 'codigo' and 'nome'.
     * It also verifies that the number of items on the page is 30 as expected by the 'perPage' parameter.
     *
     * php artisan test --filter BancosControllerTest::test_it_can_list_bancos_with_pagination
     */
    public function test_it_can_list_bancos_with_pagination()
    {
        $response = $this->get('/api/bancos?perPage=30');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonStructure([
            'data' => [
                '*' => ['codigo', 'nome'],
            ]
        ]);
        $response->assertJsonCount(30, 'data');
    }

    /**
     * Test returning a single bank by its code.
     * This test sends a GET request to the '/api/banco/{codigo}' route with a valid bank code.
     * It checks if the response status is HTTP 200 and if the JSON response contains the 'codigo' and 'nome' of the requested bank.
     *
     * php artisan test --filter BancosControllerTest::test_it_returns_single_banco_by_codigo
     */
    public function test_it_returns_single_banco_by_codigo()
    {
        $banco = Bancos::first();

        $response = $this->get("/api/banco/{$banco->codigo}");

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJsonFragment([
            'codigo' => $banco->codigo,
            'nome' => $banco->nome,
        ]);
    }

    /**
     * Test returning an error if the bank is not found.
     * This test sends a GET request to the '/api/banco/{codigo}' route with a non-existent bank code (99999).
     * It checks if the response status is HTTP 200 and the JSON response contains an error message indicating that the bank was not found.
     *
     * php artisan test --filter BancosControllerTest::test_it_returns_error_if_banco_not_found
     */
    public function test_it_returns_error_if_banco_not_found()
    {
        $response = $this->get('/api/banco/99999');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertJson([
            'error' => true,
            'msg' => 'Banco não encontrado',
        ]);
    }

    /**
     * Test returning the 'home' view when accessing the root route.
     * This test sends a GET request to the '/' route and checks if the response status is HTTP 200 and the correct view 'bancos.home' is returned.
     *
     * php artisan test --filter BancosControllerTest::test_it_returns_home_view
     */
    public function test_it_returns_home_view()
    {
        $response = $this->get('/');

        $response->assertStatus(Response::HTTP_OK);
        $response->assertViewIs('bancos.home');
    }
}
