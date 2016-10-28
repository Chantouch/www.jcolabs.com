<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests\CreateBoardRequest;
use App\Http\Requests\UpdateBoardRequest;
use App\Repositories\BoardRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class BoardController extends AppBaseController
{
    /** @var  BoardRepository */
    private $boardRepository;

    public function __construct(BoardRepository $boardRepo)
    {
        $this->boardRepository = $boardRepo;
        $this->middleware('admin');
    }

    /**
     * Display a listing of the Board.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->boardRepository->pushCriteria(new RequestCriteria($request));
        $boards = $this->boardRepository->all();

        return view('backend.boards.index')
            ->with('boards', $boards);
    }

    /**
     * Show the form for creating a new Board.
     *
     * @return Response
     */
    public function create()
    {
        return view('backend.boards.create');
    }

    /**
     * Store a newly created Board in storage.
     *
     * @param CreateBoardRequest $request
     *
     * @return Response
     */
    public function store(CreateBoardRequest $request)
    {
        $input = $request->all();

        $board = $this->boardRepository->create($input);

        Flash::success('Board saved successfully.');

        return redirect(route('admin.boards.index'));
    }

    /**
     * Display the specified Board.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $board = $this->boardRepository->findWithoutFail($id);

        if (empty($board)) {
            Flash::error('Board not found');

            return redirect(route('admin.boards.index'));
        }

        return view('backend.boards.show')->with('board', $board);
    }

    /**
     * Show the form for editing the specified Board.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $board = $this->boardRepository->findWithoutFail($id);

        if (empty($board)) {
            Flash::error('Board not found');

            return redirect(route('admin.boards.index'));
        }

        return view('backend.boards.edit')->with('board', $board);
    }

    /**
     * Update the specified Board in storage.
     *
     * @param  int $id
     * @param UpdateBoardRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBoardRequest $request)
    {
        $board = $this->boardRepository->findWithoutFail($id);

        if (empty($board)) {
            Flash::error('Board not found');

            return redirect(route('admin.boards.index'));
        }

        $board = $this->boardRepository->update($request->all(), $id);

        Flash::success('Board updated successfully.');

        return redirect(route('admin.boards.index'));
    }

    /**
     * Remove the specified Board from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $board = $this->boardRepository->findWithoutFail($id);

        if (empty($board)) {
            Flash::error('Board not found');

            return redirect(route('admin.boards.index'));
        }

        $this->boardRepository->delete($id);

        Flash::success('Board deleted successfully.');

        return redirect(route('admin.boards.index'));
    }
}
