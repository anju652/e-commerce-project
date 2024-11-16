<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Catagory;
use App\Models\product;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;

class AdminController extends Controller
{
    public function view_catagory()
    {
        $data=Catagory::all();
        return view('admin.catagory',compact('data'));

    }

    public function add_catagory(Request $request)
    {

        $catagory= new Catagory;

        $catagory->catagory_name= $request->catagory;

        $catagory->save();

        toastr()->timeout(10000)->closeButton()->addSuccess('Catagory added Successfully..');
        return redirect()->back();

    }
    public function delete_catagory($id)
    {
        $data= Catagory::find(decrypt($id));
        $data->delete();
        toastr()->timeout(10000)->closeButton()->addSuccess('Catagory deleted Successfully..');
        return redirect()->back();

    }
    public function edit_catagory($id)
    {
        $data=Catagory::find(decrypt($id));
        return view('admin.update_catagory',compact('data'));
    }
    public function update_catagory(Request $request,$id)
    {
        $data=Catagory::find($id);
         
        $data->catagory_name=$request->catagory;

        $data->save();

        toastr()->timeout(10000)->closeButton()->addSuccess('Catagory Updated Successfully..');

        return redirect('/view_catagory');

    }
    public function add_product()
    {
        $catagory=Catagory::all();
        return view('admin.add_product',compact('catagory'));
    }
    public function upload_product(Request $request)
    {
        $data= new product;
        $data->title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->quantity = $request->qty;
        $data->catagory = $request->catagory;

        $image=$request->image;
        if ($image)
        {
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('products',$imagename);
            $data->image = $imagename;

        }

        $data->save();
        toastr()->timeout(10000)->closeButton()->addSuccess('Product Added Successfully..');
        return redirect()->back();
    }

    public function view_product()
    {
        $product = product::paginate(3);
        return view('admin.view_product',compact('product'));
    }
    public function delete_product($id)
    {
        $data= product::find(decrypt($id));
        $image_path= public_path('products/'.$data->image);
        if(file_exists($image_path))
        {
            unlink($image_path);
        }
        $data->delete();
         toastr()->timeout(10000)->closeButton()->addSuccess('Product deleted Successfully..');
        return redirect()->back();
    }

    public function edit_product($id)
    {
        $data=product::find(decrypt($id));
        $catagory=Catagory::all();
        return view('admin.update_product',compact('data','catagory'));
    }
    public function update_product(Request $request,$id)
    {
        $product=product::find($id);
        $product->title=$request->title;
        $product->description=$request->description;
        $product->price=$request->price;
        $product->quantity=$request->qty;
        $product->catagory=$request->catagory;
        $image=$request->image;
        if ($image)
        {
            $imagename = time().'.'.$image->getClientOriginalExtension();
            $request->image->move('products',$imagename);
            $product->image = $imagename;

        }
        $product->save();
        toastr()->timeout(10000)->closeButton()->addSuccess('Product Updated Successfully..');
        return redirect('/view_product');

    }

    public function search_product(Request $request)
    {
        $search = $request->search;
        $product= product::where('title','LIKE','%'.$search.'%')->orWhere('catagory','LIKE','%'.$search.'%')->paginate(2);
        return view('admin.view_product',compact('product'));
    }

    public function view_orders()
    {
        $order=Order::all();
        return view('admin.view_orders',compact('order'));

    }
    public function on_the_way($id)
    {
        $data = Order::find($id);
        $data->status = 'On the Way';
        $data->save();
        return redirect('/view_orders');

    }
     public function delivered($id)
    {
         $data = Order::find($id);
        $data->status = 'Delivered';
        $data->save();
        return redirect('/view_orders');
    }

    public function print_pdf($id)
    {
        $data=Order::find($id);
        $pdf = Pdf::loadView('admin.invoice',compact('data'));
            return $pdf->download('invoice.pdf');
    }
}
