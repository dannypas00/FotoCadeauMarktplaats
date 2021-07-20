<?php

namespace App\Http\Controllers;

use App\Models\Advert;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdvertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @param int $amountPerPage
     * @param int $pageNr
     * @return Response
     */
    public function list(Request $request): Response
    {
        $filters = $request->input('filters') ?? [];
        $query = Advert::on();

        // Filter per advertiser
        if (array_key_exists('advertiser', $filters)) {
            $query = $query->where('poster', '=', $filters['advertiser']);
        }

        // Filter by search terms
        if (array_key_exists('search_terms', $filters)) {
            foreach ($filters['search_terms'] as $term) {
                $term = '%' . $term . '%';
                $query = $query->where('heading', 'like', $term)->orWhere('body', 'like', $term);
            }
        }

        // Paginate by number of items per page
        if (array_key_exists('page_number', $filters)) {
            $query = $query->forPage($filters['page_number'], $filters['per_page']);
        }

        return new Response($query->get()->toArray(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {
        return new Response(Advert::on()->create($request->input()), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Advert $advert
     * @return Response
     */
    public function read(Advert $advert)
    {
        return new Response($advert, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Advert $advert
     * @param Request $request
     * @return Response
     */
    public function update(Advert $advert, Request $request)
    {
        return new Response($advert->update($request->input()));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Advert $advert
     * @return Response
     */
    public function delete(Advert $advert)
    {
        return new Response($advert->delete());
    }
}
