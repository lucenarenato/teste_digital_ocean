<?php 

   	//use Bugsnag\BugsnagLaravel\Facades\Bugsnag;
	//use RuntimeException;

    namespace App\Http\Controllers;

    //use Input;

	use App\Item;

	use DB;

	use Excel;

	use Illuminate\Http\Request;

	class MaatwebsiteDemoController extends Controller

	{
		    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function importExport()

    {

        return view('importExport');

    }

 

    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function downloadExcel($type)

    {

        $data = Item::get()->toArray();

            

        return Excel::create('itsolutionstuff_example', function($excel) use ($data) {

            $excel->sheet('mySheet', function($sheet) use ($data)

            {

                $sheet->fromArray($data);

            });

        })->download($type);

    }


    /**

     * Display a listing of the resource.

     *

     * @return \Illuminate\Http\Response

     */

    public function importExcel(Request $request)

    {

        $request->validate([

            'import_file' => 'required'

        ]);

 

        $path = $request->file('import_file')->getRealPath();

        $data = Excel::load($path)->get();

 

        if($data->count()){

            foreach ($data as $key => $value) {

                $arr[] = ['title' => $value->title, 'description' => $value->description];

            }

 

            if(!empty($arr)){

                Item::insert($arr);

            }

        }

 

        return back()->with('success', 'Insert Record successfully.');

    }

}

		/*public function importExport()

		{

			return view('importExport');

		}

		public function downloadExcel($type)

		{

			$data = Item::get()->toArray();

			return Excel::create('itsolutionstuff_example', function($excel) use ($data) {

				$excel->sheet('mySheet', function($sheet) use ($data)

		        {

					$sheet->fromArray($data);

		        });

			})->download($type);

		}

		public function importExcel()

		{

			if(Input::hasFile('import_file')){

				$path = Input::file('import_file')->getRealPath();

				$data = Excel::load($path, function($reader) {

				})->get();

				if(!empty($data) && $data->count()){

					foreach ($data as $key => $value) {

						$insert[] = ['title' => $value->title, 'description' => $value->description];

					}

					if(!empty($insert)){

						DB::table('items')->insert($insert);

						dd('Insert Record successfully.');

					}

				}

			}

			return back();

		}

	}*/