<?php

namespace App\Http\Controllers;


use App\Http\Helpers\Helper;
use App\Models\TodoList;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

/**
 *
 * Class ToDoController
 *
 * @author ÖMER MİRAÇ KÖKÇAM <omermirac.kokcam@gmail.com>
 */
class ToDoController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * for to do view
     */
    public function index(){
        return view('todo');
    }

    /**
     * @return void
     */
    public function get_excel_table(){
        Helper::create_excel_table('todo_list');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function fetch(){
        $todos = TodoList::query()->orderByDesc('created_at');

        return DataTables::of($todos)
            ->editColumn('todo_item',function ($data){
                return $data->is_done == 1 ? '<del>'.$data->todo_item.'</del>' : $data->todo_item ;
            })
            ->editColumn('is_done',function ($data){
                if($data->is_done == 0){
                    return '<button class="btn btn-danger" data-toggle="tooltip" onClick="change_is_done_status('.$data->id.')" title="İşin durumunu değiş">Tamamlanmadı</button>';
                }
                return '<button class="btn btn-success" data-toggle="tooltip" onClick="change_is_done_status('.$data->id.')" title="İşin durumunu değiş">Tamamlandı</button>';
            })
            ->addColumn('button_delete',function ($data){
                return '<button class="btn btn-danger" data-toggle="tooltip" onClick="remove('.$data->id.')" title="İşi sil">Sil</button>';
            })
            ->addColumn('button_update',function ($data){
                return '<button class="btn btn-warning" data-toggle="tooltip" onClick="detail('.$data->id.')" title="İşi güncelle">Güncelle</button>';
            })->editColumn('created_at', function ($data) {
                if ($data->created_at) {
                    $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)
                        ->format('d-m-Y // H:i:s');
                    return $formatedDate;
                } else {
                    return null;
                }

            })
            ->editColumn('updated_at', function ($data) {
                if ($data->updated_at) {
                    $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->updated_at)
                        ->format('d-m-Y // H:i:s');
                    return $formatedDate;
                } else {
                    return null;
                }
            })
            ->rawColumns(['todo_item','is_done','button_delete','button_update','created_at','updated_at'])->make(true);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function detail(Request $request){
        $request->validate([
            'id'=>'distinct',
        ]);
        $todo = TodoList::find($request->id);
        return response()->json(['id'=>$todo->id,
                                'todo_item'=>$todo->todo_item,
                                'is_done'=>$todo->is_done,
                                'updated_at'=>$todo->updated_at]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request){
        $request->validate([
            'todo_item'=>['required','max:255']
        ]);
        $todo = new TodoList();
        foreach ($request->all() as $key => $value){
            $request->$key = Helper::strip_tags($value);
            $todo->$key = $request->$key;
        }

        if($todo->save()){
            return response()->json(['success' => 'Success']);
        }
        return response()->json(['error'=>'Bir hata oluştu. Lütfen tekrar deneyiniz.']);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request){
        $request->validate([
            'id'=>'distinct',
            'todo_item'=>['required','max:255'],
            'is_done'=>['required',Rule::in([0,1])]
        ]);
        $todo = TodoList::find($request->id);
        foreach ($request->all() as $key => $value){
            $request->$key = Helper::strip_tags($value);
            $todo->$key = $request->$key;
        }
        if($todo->save()){
            return response()->json(['success' => 'Success']);
        }
        return response()->json(['error'=>'Bir hata oluştu. Lütfen tekrar deneyiniz.']);
    }

    /**
     * @param Request $request
     * @return void
     */
    public function change_is_done_status(Request $request){
        $request->validate([
            'id'=>'distinct',
        ]);
        $todo = TodoList::find($request->id);
        $todo->is_done = $todo->is_done == 0 ? 1 : 0;
        $todo->save();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(Request $request){
        $request->validate([
            'id'=>'distinct',
        ]);
        if(TodoList::find(request('id'))->delete()){
            return response()->json(['success' => 'Success']);
        }
        return response()->json(['error'=>'Bir hata oluştu. Lütfen tekrar deneyiniz.']);
    }


}
