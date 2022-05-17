<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Aktifitasadmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Data Petugas';
        $user = User::whereId(auth()->user()->id)->first();
        $petugas = User::whereRole('Petugas')->filter(request(['q']))->latest()->paginate(10)->withQueryString();;
        return view('backend.petugas.petugas', Compact('title', 'user', 'petugas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Tambah Petugas';
        $user = User::whereId(auth()->user()->id)->first();
        return view('backend.petugas.tambah-petugas', compact('title', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'required' => ':attribute wajib diisi!',
            'min' => ':attribute terlalu pendek!',
            'max' => ':attribute terlalu pendek!',
            'unique' => ':attribute sudah tersedia!'
        ];

        $request->validate([
            'id-petugas' => 'required',
            'nama' => 'required',
            'username' => 'required|unique:users|max:24|min:6',
            'password1' => 'required|max:12|min:8',
            'password1' => 'required|max:12|min:8',
        ], $messages);

        if($request->password1 == $request->password2){
            User::Create([
                'id_petugas' => 'PEP'.date('dmY', strtotime(now())).User::max('id'),
                'nama' => $request->nama,
                'username' => $request->username,
                'aktifitas' => 'Ditambahkan',
                'password' => Hash::make($request->password1)
            ]);
            return redirect('admin/petugas')->with(['alert' => 'success',
                                                  'pesan' => 'Petugas berhasil ditambahkan'
                                                ]);
        }
        Aktifitasadmin::create([
            'user_id' => Auth()->user()->id,
            'icon' => 'fas fa-user-tie',
            'backgroud' => 'bg-success',
            'notifikasi' => 'Berhasil menambahkan petugas ' .$request->nama,
        ]);
        return back()->with(['alert' => 'error',
                             'pesan' => 'Password tidak sama!'
                            ]);
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
    public function edit($id)
    {
        $title = 'Edit Petugas';
        $user = User::whereId(auth()->user()->id)->first();
        $petugas = User::findorFail($id);
        return view('backend.petugas.edit-petugas', compact('title', 'user', 'petugas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $messages = [
            'required' => ':attribute wajib diisi!',
            'min' => ':attribute terlalu pendek!',
            'max' => ':attribute terlalu pendek!',
            'unique' => ':attribute sudah tersedia!'
        ];
        $request->validate([
            'nama' => 'required',
            'username' => 'required|max:24|min:6|unique:users,username,' . $id
        ], $messages);

        User::find($id)->update([
            'nama' => $request->nama,
            'username' => $request->username
        ]);

        Aktifitasadmin::create([
            'user_id' => Auth()->user()->id,
            'icon' => 'fas fa-user-tie',
            'backgroud' => 'bg-secondary',
            'notifikasi' => 'Berhasil mengedit petugas ' .$request->nama,
        ]);

        return redirect('admin/petugas')->with(['alert'=>'success',
                                                'pesan' => 'Petugas Berhasil diedit'
                                               ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete($id);
        Aktifitasadmin::create([
            'user_id' => Auth()->user()->id,
            'icon' => 'fas fa-user-tie',
            'backgroud' => 'bg-danger',
            'notifikasi' => 'Berhasil menghapus petugas ' .$user->nama,
        ]);
        return redirect('admin/petugas')->with(['alert' => 'success',
                                                 'pesan' => 'Petugas berhasil dihapus'
                                               ]);
    }
}
