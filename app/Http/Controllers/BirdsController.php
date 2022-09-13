<?php

namespace App\Http\Controllers;
use App\Models\Birds;
use GuzzleHttp\Psr7\Request;
use App\Validation\BirdsValidator;
use App\Http\Requests\BirdsRequest;
use App\Repository\BirdsRepo as repo;

class BirdsController extends Controller
{
    //
    private $repo;
    public function __construct(repo $repo)
    {
        $this->repo = $repo;
    }

    public function index()
    {
        return view('birds.index',
        [
            'birdsObjects'=>Birds::all()
        ]);
    }

    public function create()
    {
        return view('birds.create');
    }

    public function store(BirdsRequest $request)
    {
        Birds::create($request->validated());
        return view('birds.index',
        [
            'birdsObjects'=>Birds::paginate(4)
        ]);
    }

    public function edit($id = null)
    {
        return View('admin.index')->with(['data' => $this->repo->postOfId($id)]);
    }

    public function editPost()
    {
        $all = Input::all();
        $validate = BirdsValidator::validate($all);
        if (!$validate->passes()) {
            return redirect()->back()->withInput()->withErrors($validate);
        }
        $Id = $this->repo->postOfId($all['id']);
        if (!is_null($Id)) {
            $this->repo->update($Id, $all);
            Session::flash('msg', 'edit success');
        } else {
            $this->repo->create($this->repo->perpare_data($all));
            Session::flash('msg', 'add success');
        }
        return redirect()->back();
    }

    public function retrieve()
    {
        return View('admin.index')->with(['Data' => $this->repo->retrieve()]);
    }

    public function delete()
    {
        $id = Input::get('id');
        $data = $this->repo->postOfId($id);
        if (!is_null($data)) {
            $this->repo->delete($data);
            Session::flash('msg', 'operation Success');
            return redirect()->back();
        } else {
            return redirect()->back()->withErrors('operationFails');
        }
    }

}
