      </div>
    </div>
    <div id="footer">
      <div id="main-whitebox-bottom"></div>
      <div class="michigan-circle">
      <? if(is_category('civil-war') || preg_match('/civilwar/',BODY_CLASS)): ?>
      <a href="http://seekingmichigan.org/copyright">
          <img src="/images/cw-logo.png" alt="Michigan Sesquicentennial of the Civil War Commission" />
        </a>
      <? else: ?>
        <a href="http://mi.gov">
          <img src="/images/michigan-state-circle.png" alt="michigan seal" />
        </a>
      <? endif; ?>
      </div>
      <div class="wrapper">
        <div class="links">
          <ul class="first">
            <li><a href="/">Home</a></li>
            <li><a href="http://seekingmichigan.cdmhost.com/seeking_michigan/seek_advanced.php">Seek</a></li>
            <li><a href="/discover">Discover</a></li>
            <li><a href="/look">Look</a></li>
            <li><a href="/teach">Teach</a></li>
            <li><a href="http://micivilwar.org">Civil War 150</a></li>
          </ul>
          <ul class="second">
            <li><a href="/about">About</a></li>
            <li><a href="/resources">Resources</a></li>
            <li><a href="/archive">Archives</a></li>
            <li><a href="/copyright">Copyright</a></li>
          </ul>
          <p>&copy; 2008-<?= date('Y'); ?> <a href="<?= get_settings('home'); ?>">SeekingMichigan.org</a>. All Rights Reserved.  </p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
