      <!-- Footer -->

      <footer class="footer container-fluid pl-30 pr-30">
        <div class="row">
          <div class="col-sm-12">
            <p>{{ date('Y')}} &copy; {{config('app.longName')}}. Developed By Don Peter Atunalu</p>
          </div>
        </div>
      </footer>
      <!-- /Footer -->
    </div>
  </div>
  <!-- /Main Content -->

</div>
<!-- /#wrapper -->
  <!-- JavaScript -->
  
  <!-- jQuery -->
  <script src="{{asset('vendors/bower_components/jquery/dist/jquery.min.js')}}"></script>

  <!-- Bootstrap Core JavaScript -->
  <script src="{{asset('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
  
  <!-- Slimscroll JavaScript -->
  <script src="{{asset('dist/js/jquery.slimscroll.js')}}"></script>
  
  <!-- Switchery JavaScript -->
  <script src="{{asset('vendors/bower_components/switchery/dist/switchery.min.js')}}"></script>
  <!-- Fancy Dropdown JS -->
  <script src="{{asset('dist/js/dropdown-bootstrap-extended.js')}}"></script>
  
  <!-- Init JavaScript -->
  <script src="{{asset('dist/js/init.js')}}"></script>
  <!-- Custom Scripts -->
 @stack('scripts')
</body>

</html>