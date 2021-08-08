<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PortfolioGroup;
use App\Http\Requests\PortfolioGroupRequest;
use PDOException;

class PortfolioGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $portfoliosGroups = PortfolioGroup::where('active', true)->get();

        return view('admin.group-portfolio.index', compact('portfoliosGroups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.group-portfolio.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PortfolioGroupRequest $request)
    {

        $data = $request->all();

        if(!isset($data)) {
            
            return redirect()
                ->back()
                ->withErrors($data);
        } else {

            try {

                $data['active'] = $request->has('active');

                PortfolioGroup::create($data);
                
                return redirect('/painel/grupo-portfolio')
                    ->with('success', 'Grupo de portfólio criado com sucesso!');

            } catch(\Exception $ex) {

                echo $ex->getMessage();

                return redirect()->back();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($grupo_portfolio)
    {
        $portfolioGroup = PortfolioGroup::findOrfail($grupo_portfolio)->first();

        return view('admin.group-portfolio.edit', compact('portfolioGroup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PortfolioGroupRequest $request, $grupo_portfolio)
    {
        $data = $request->all();

        $portfolioGroup = PortfolioGroup::findOrfail($grupo_portfolio);

        if($portfolioGroup) {

            $portfolioGroup->update($data);

            return redirect('/painel/grupo-portfolio')->with('success', 'Grupo de portfólio editado com sucesso!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($grupo_portfolio)
    {  
        $portfolioGroup = PortfolioGroup::findOrFail($grupo_portfolio);

        if($portfolioGroup) {

            $portfolioGroup->delete($grupo_portfolio);

            return redirect('/painel/grupo-portfolio')->with('success', 'Grupo de portfólio deletado com sucesso!');
        }
    }
}