   <div class="modal fade" id="startCheckIn" tabindex="-1" aria-labelledby="startCheckInLabel" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered modal-xl">
           <div class="modal-content">
               <div class="modal-header text-bg-primary">
                   <h1 class="modal-title fs-5" id="startCheckInLabel">Check In Absensi</h1>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" id="btnStopCheckIn"
                       aria-label="Close"></button>
               </div>
               <div class="modal-body">
                   <div class="row align-items-center">
                       @if (is_null($checkIn))
                           <div class="col">
                               <div class="row">
                                   <div class=" d-flex flex-column gap-2">
                                       <video id="video" class="rounded-4 border border-5" autoplay
                                           playsinline></video>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="col mb-3">
                                       <canvas id="photoCanvas" class="d-none"></canvas>
                                       <img id="photoPreview" class="rounded-5 border border-5" />
                                   </div>
                               </div>

                           </div>
                       @else
                           <div class="col d-flex flex-column gap-2">
                               @if ($errors->any())
                                   <div class="alert alert-danger">
                                       <ul>
                                           @foreach ($errors->all() as $error)
                                               <li>{{ $error }}</li>
                                           @endforeach
                                       </ul>
                                   </div>
                               @endif
                               <video id="video" autoplay playsinline class="rounded-5 border border-5"
                                   style="display: none"></video>
                               <img id="photoPreview" class="rounded-5 border border-5"
                                   src="{{ asset('storage/' . $checkIn->foto_masuk) }}" alt="Foto Absen Masuk">
                               <canvas id="photoCanvas" style="display: none;"></canvas>
                               <button class="btn btn-primary" id="startCheckOut">Start Check Out</button>
                               <button class="btn btn-primary" id="takePhoto" style="display: none">Confirm Check
                                   Out</button>
                               <div class="col">
                                   <div class="col d-flex gap-3">
                                       <button id="retakePhoto" class="btn btn-warning" hidden>Ambil Ulang
                                           Foto</button>
                                       <form id="checkinForm" action="{{ route('karyawan.absensi.checkOut') }}"
                                           method="POST" style="display: none;">
                                           @csrf
                                           @method('PUT')
                                           <input type="hidden" name="foto_keluar" id="photoData">
                                           <input type="hidden" name="latitude_keluar" id="latitude_keluar">
                                           <input type="hidden" name="longitude_keluar" id="longitude_keluar">
                                           <input type="hidden" name="check_out_time_client"
                                               id="check_out_time_client">
                                           <input type="hidden" name="user_timezone" id="user_timezone">
                                           <button type="submit" class="btn btn-success">Submit CheckOut</button>
                                       </form>
                                   </div>
                               </div>
                           </div>

                       @endif
                       <div class="col table-responsive">
                           <table class="table align-middle">
                               <tbody>
                                   <tr>
                                       <td>Nama</td>
                                       <td>:&nbsp;{{ auth()->user()->name }}</td>
                                   </tr>
                                   <tr>
                                       <td>Jabatan</td>
                                       <td>:&nbsp;{{ auth()->user()->karyawan->jabatan->nama }}</td>
                                   </tr>
                                   <tr>
                                       <td>Department</td>
                                       <td>:&nbsp;{{ auth()->user()->karyawan->department->nama }}</td>
                                   </tr>
                                   <tr>
                                       <td>Tanggal</td>
                                       <td id="tanggal"></td>
                                   </tr>
                                   <tr>
                                       <td>Jam</td>
                                       <td id="jam"></td>
                                   </tr>
                                   <tr>
                                       <td>Lokasi</td>
                                       <td id="lokasi"></td>
                                   </tr>
                                   <tr>
                                       <td>Status</td>
                                       <td>
                                           @if ($checkIn)
                                               :&nbsp;Sudah check-in jam {{ $checkIn->jam_masuk }}
                                               {{ $checkIn->status }}
                                           @else
                                               :&nbsp;Belum melakukan check-in hari ini
                                           @endif
                                       </td>
                                   </tr>
                               </tbody>
                           </table>
                       </div>
                   </div>
               </div>
               <div class="modal-footer">
                   <button type="button" id="btnTakePhoto" class="btn btn-primary"><i class="bi bi-camera"></i> Ambil
                       Foto</button>
                   <button type="button" id="btnRetakePhoto" class="btn btn-warning d-none"> <i
                           class="bi bi-camera"></i> Ambil Ulang Foto
                   </button>
                   <form id="checkinForm" action="{{ route('karyawan.absensi.checkIn') }}" method="POST"
                       class="d-none">
                       @csrf
                       <input type="hidden" name="foto_masuk" id="photoData">
                       <input type="hidden" name="latitude_masuk" id="latitude_masuk">
                       <input type="hidden" name="longitude_masuk" id="longitude_masuk">
                       <input type="hidden" name="check_in_time_client" id="check_in_time_client">
                       <input type="hidden" name="user_timezone" id="user_timezone">
                       <input type="hidden" name="lokasi" id="user_lokasi">
                       <button type="submit" class="btn btn-success"> <i class="bi bi-floppy"></i> Submit
                           Check-in</button>
                   </form>
               </div>
           </div>
       </div>
   </div>
