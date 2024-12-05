<!-- JAVASCRIPT -->
 <script src="{{ URL::asset('build/assets/libs/jquery/jquery.min.js')}}"></script>
 <script src="{{ URL::asset('build/assets/libs/bootstrap/bootstrap.min.js')}}"></script>
 <script src="{{ URL::asset('build/assets/libs/metismenu/metismenu.min.js')}}"></script>
 <script src="{{ URL::asset('build/assets/libs/simplebar/simplebar.min.js')}}"></script>
 <script src="{{ URL::asset('build/assets/libs/node-waves/node-waves.min.js')}}"></script>
 <script src="{{ URL::asset('build/assets/libs/waypoints/waypoints.min.js')}}"></script>
 <script src="{{ URL::asset('build/assets/libs/jquery-counterup/jquery-counterup.min.js')}}"></script>

 @yield('script')

 <!-- App js -->
 <script src="{{ URL::asset('build/assets/js/app.min.js')}}"></script>
 
 @yield('script-bottom')