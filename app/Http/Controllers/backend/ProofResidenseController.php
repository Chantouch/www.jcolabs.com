<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests\CreateProofResidenseRequest;
use App\Http\Requests\UpdateProofResidenseRequest;
use App\Repositories\ProofResidenseRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ProofResidenseController extends AppBaseController
{
    /** @var  ProofResidenseRepository */
    private $proofResidenseRepository;

    public function __construct(ProofResidenseRepository $proofResidenseRepo)
    {
        $this->proofResidenseRepository = $proofResidenseRepo;
        $this->middleware('admin');
    }

    /**
     * Display a listing of the ProofResidense.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->proofResidenseRepository->pushCriteria(new RequestCriteria($request));
        $proofResidenses = $this->proofResidenseRepository->all();

        return view('backend.proof_residenses.index')
            ->with('proofResidenses', $proofResidenses);
    }

    /**
     * Show the form for creating a new ProofResidense.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.proof_residenses.create');
    }

    /**
     * Store a newly created ProofResidense in storage.
     *
     * @param CreateProofResidenseRequest $request
     *
     * @return Response
     */
    public function store(CreateProofResidenseRequest $request)
    {
        $input = $request->all();

        $proofResidense = $this->proofResidenseRepository->create($input);

        Flash::success('Proof Residense saved successfully.');

        return redirect(route('admin.proofResidenses.index'));
    }

    /**
     * Display the specified ProofResidense.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $proofResidense = $this->proofResidenseRepository->findWithoutFail($id);

        if (empty($proofResidense)) {
            Flash::error('Proof Residense not found');

            return redirect(route('admin.proofResidenses.index'));
        }

        return view('backend.proof_residenses.show')->with('proofResidense', $proofResidense);
    }

    /**
     * Show the form for editing the specified ProofResidense.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $proofResidense = $this->proofResidenseRepository->findWithoutFail($id);

        if (empty($proofResidense)) {
            Flash::error('Proof Residense not found');

            return redirect(route('admin.proofResidenses.index'));
        }

        return view('backend.proof_residenses.edit')->with('proofResidense', $proofResidense);
    }

    /**
     * Update the specified ProofResidense in storage.
     *
     * @param  int              $id
     * @param UpdateProofResidenseRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProofResidenseRequest $request)
    {
        $proofResidense = $this->proofResidenseRepository->findWithoutFail($id);

        if (empty($proofResidense)) {
            Flash::error('Proof Residense not found');

            return redirect(route('admin.proofResidenses.index'));
        }

        $proofResidense = $this->proofResidenseRepository->update($request->all(), $id);

        Flash::success('Proof Residense updated successfully.');

        return redirect(route('admin.proofResidenses.index'));
    }

    /**
     * Remove the specified ProofResidense from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $proofResidense = $this->proofResidenseRepository->findWithoutFail($id);

        if (empty($proofResidense)) {
            Flash::error('Proof Residense not found');

            return redirect(route('admin.proofResidenses.index'));
        }

        $this->proofResidenseRepository->delete($id);

        Flash::success('Proof Residense deleted successfully.');

        return redirect(route('admin.proofResidenses.index'));
    }
}
