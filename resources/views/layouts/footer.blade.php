      <!-- Footer -->

      <footer class="footer container-fluid pl-30 pr-30">
        <div class="row">
          <div class="col-sm-12">
            <p>{{ date('Y')}} &copy; {{config('app.longName')}}. <a href="//www.donpeter.me" target="_blank">Developed By Don Peter Atunalu</a></p>
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
  <script src="{{asset('js/bundle.min.js')}}"></script>

  <script src="{{asset('dist/js/dropdown-bootstrap-extended.js')}}"></script>
  
  <!-- Init JavaScript -->
  <script src="{{asset('dist/js/init.js')}}"></script>
  <!-- Custom Scripts -->
 @stack('scripts')
</body>

</html>