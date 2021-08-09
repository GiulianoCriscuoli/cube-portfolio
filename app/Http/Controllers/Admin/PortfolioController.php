<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PortfolioRequest;
use Illuminate\Http\Request;
use App\Models\Portfolio;

class PortfolioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $portfolios = Portfolio::all();

        return view('admin.portfolio.index', compact('portfolios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.portfolio.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PortfolioRequest $request)
    {
        $data = $request->all();

        if(!isset($data)) {

            return redirect()
                ->back()
                ->withErrors($data);
        } else {

            try {
                
                if($request->hasFile('image') && $request->file('image')->isValid()) {
                    
                    $requestImage = $request->image;
        
                    $ext = $requestImage->extension();
        
                    $imageName = md5($requestImage->getClientOriginalName().strtotime("now").".".$ext);

                    $requestImage->move(public_path('images/upload'), $imageName);

                    $data['image'] = $imageName;

                }
    
                $data['active'] = $request->has('active');
    
                Portfolio::create($data);
        
                return redirect('painel/portfolio')
                    ->with('success', 'Portfólio criado com sucesso!');

            } catch(\Exception $ex ) {

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
    public function edit($portfolio)
    {
        $portfolio = Portfolio::findOrFail($portfolio);

        if($portfolio) {

            return view('admin.portfolio.edit', compact('portfolio'));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PortfolioRequest $request, $portfolio)
    {
        $data = $request->all();

        $portfolio = Portfolio::findOrFail($portfolio);
        
        if($portfolio) {
            
            if($request->hasFile('image') && $request->file('image')->isValid()) {
                
                $requestImage = $request->image;
                
                $ext = $requestImage->extension();
                $imageName = md5($requestImage->getClientOriginalName().strtotime("now").".".$ext);
                
                $requestImage->move(public_path('images/upload'), $imageName);

                $data['image'] = $imageName;
            }

            $data['active'] = $request->has('active');

            $portfolio->update($data);

            return redirect('painel/portfolio')
                ->with('success', 'Portfólio editado com sucesso!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($portfolio)
    {
        $portfolio = Portfolio::findOrFail($portfolio);

        if($portfolio) {

            $portfolio->delete($portfolio);

            return redirect('painel/portfolio')->with('success', 'Portfólio excluído com sucesso!');
        }
    }
}
