<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePieceRequest;
use App\Http\Requests\UpdatePieceRequest;
use App\Http\Resources\PieceResource;
use App\Models\Piece;
use Illuminate\Http\Response;
use Inertia\Inertia;

class PieceController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index() {
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param StorePieceRequest $request
	 * @return Response
	 */
	public function store(StorePieceRequest $request) {
		//
	}

	/**
	 * Display the specified resource.
	 */
	public function show(string $pieceId) {
		$piece = Piece::where('editionNumber', $pieceId)->firstOrFail();

		return Inertia::render('Piece', ['piece' => new PieceResource($piece),]);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param Piece $piece
	 * @return Response
	 */
	public function edit(Piece $piece) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param UpdatePieceRequest $request
	 * @param Piece $piece
	 * @return Response
	 */
	public function update(UpdatePieceRequest $request, Piece $piece) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param Piece $piece
	 * @return Response
	 */
	public function destroy(Piece $piece) {
		//
	}
}
