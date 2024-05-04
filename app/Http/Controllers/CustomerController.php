<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class CustomerController extends Controller
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render("Customers/Index", [
            "customers" => Customer::all()->map(function ($customer) {
                return [
                    'id' => $customer->id,
                    'name' => $customer->name,
                    'email' => $customer->email,
                ];
            })
        ]);
    }

    /**
     * @return Response
     */
    public function create(): Response
    {
        return Inertia::render("Customers/Create", []);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            "name" => "required|max:255",
            "email" => "required|email|unique:customers,email",
            "phone" => "required|unique:customers,phone|numeric",
        ]);

        Customer::query()->create($validated);


        return Redirect::route("customers.index");
    }

    /**
     * @param Customer $customer
     * @return RedirectResponse
     */
    public function destroy(Customer $customer): RedirectResponse
    {
        $customer->delete();
        return Redirect::route("customers.index");
    }

    /**
     * @param Customer $customer
     * @return Response
     */
    public function edit(Customer $customer): Response
    {
        return Inertia::render("Customers/Edit", [
            "customer" => $customer
        ]);
    }

    /**
     * @param Customer $customer
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(Customer $customer, Request $request):RedirectResponse
    {
        $validated = $request->validate([
            "name" => "required|max:255",
            "email" => "required|email|",
            "phone" => "required|numeric",
        ]);

        $customer->fill($validated)->save();
        return Redirect::route("customers.index");
    }
}
