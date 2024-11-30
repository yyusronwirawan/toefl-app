<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Setting\TemplateRepository;
use App\Repositories\MasterData\CategoryRepository;
use App\Http\Requests\Setting\TemplateRequest;

class TemplateController extends Controller
{
    protected $templateRepository;

    public function __construct(TemplateRepository $templateRepository)
    {
        $this->templateRepository = $templateRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return inertia('Admin/Setting/Template/Index', [
            'templates' => $this->templateRepository->getAllPaginatedWithParams($request)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('Admin/Setting/Template/Create', [
            'categories' => (new CategoryRepository())->getAllWithValueCategory()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TemplateRequest $request)
    {
        try {
            $template = $this->templateRepository->create($request->all());

            return redirect()->route('admin.templates.index');

        } catch(\Exception $e) {
            session()->flash('failed', $e->getMessage() . ' in file :'.$e->getFile() .' line: '. $e->getLine());

            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$this->templateRepository->find($id)) return abort('404', 'uppss....');

        return inertia('Admin/Setting/Template/Edit', [
            'template' => $this->templateRepository->find($id),
            'categories' => (new CategoryRepository())->getAllWithValueCategory()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TemplateRequest $request, $id)
    {
        try {
            if(!$this->templateRepository->find($id)) return abort('404', 'uppss....');

            $this->templateRepository->update($request->all(), $id);

            return redirect()->route('admin.templates.index');

        } catch(\Exception $e) {
            session()->flash('failed', $e->getMessage() . ' in file :'.$e->getFile() .' line: '. $e->getLine());

            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->templateRepository->delete($id);

            return redirect()->route('admin.templates.index');

        } catch(\Exception $e) {
            session()->flash('failed', $e->getMessage() . ' in file :'.$e->getFile() .' line: '. $e->getLine());
            
            return redirect()->back()->withInput($request->all());
        }
    }

    public function generateTemplate($id)
    {
        $template = $this->templateRepository->find($id);
        return view('certificate.generate_certificate')->with([
            'template' => $template
        ]);
    }

    public function storeGenerateTemplate(Request $request, $id)
    {
        $this->templateRepository->update($request->all(), $id);
        return redirect()->route('admin.templates.generate-template', $id);
    }

}