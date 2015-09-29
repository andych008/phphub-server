<?php

namespace PHPHub\Http\ApiControllers;

use PHPHub\Node;
use PHPHub\Repositories\TopicRepositoryInterface;
use PHPHub\Transformers\TopicTransformer;
use PHPHub\User;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
    /**
     * @var TopicRepositoryInterface
     */
    private $repository;

    /**
     * TopicController constructor.
     *
     * @param TopicRepositoryInterface $repository
     */
    public function __construct(TopicRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->addAvailableInclude('user', ['name', 'avatar']);
        $this->repository->addAvailableInclude('last_reply_user', ['name']);
        $this->repository->addAvailableInclude('node', ['name']);

        $data = $this->repository
            ->autoWith()
            ->skipPresenter()
            ->autoWithRootColumns([
                'id', 'title', 'is_excellent', 'reply_count', 'updated_at',
            ])
            ->paginate(per_page());

        return $this->response()->paginator($data, new TopicTransformer());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->repository->addAvailableInclude('user', ['name', 'avatar']);
        $this->repository->addAvailableInclude('replies', ['vote_count']);
        $this->repository->addAvailableInclude('replies.user', ['name', 'avatar']);

        $data = $this->repository->skipPresenter()->autoWith()->find($id);

        return $this->response()->item($data, new TopicTransformer());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
