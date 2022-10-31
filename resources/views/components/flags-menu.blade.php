<div class="dropdown">
  <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    <img width="20" src="/images/flags-languages/en.svg" alt="English"> English
  </button>
  <ul class="dropdown-menu" aria-labelledby="flags-dropdown" id="flags-dowpdown-list">
    <li>
      <a
        class="dropdown-item"
        href="{{ route(\Illuminate\Support\Facades\Route::getCurrentRoute()->getName(), array_merge(request()->all(), ['lang' => 'en'])) }}"
      >
        <img src="/images/flags-languages/en.svg" alt="English">English
      </a>
    </li>
    <li>
      <a
        class="dropdown-item"
        href="{{ route(\Illuminate\Support\Facades\Route::getCurrentRoute()->getName(), array_merge(request()->all(), ['lang' => 'fr'])) }}"
      >
        <img src="/images/flags-languages/fr.svg" alt="French">French
      </a>
    </li>
    <li>
      <a
        class="dropdown-item"
        href="{{ route(\Illuminate\Support\Facades\Route::getCurrentRoute()->getName(), array_merge(request()->all(), ['lang' => 'es'])) }}"
      >
        <img src="/images/flags-languages/es.svg" alt="Spanish">Spanish
      </a>
    </li>
    <li><a class="dropdown-item"
           href="{{ route(\Illuminate\Support\Facades\Route::getCurrentRoute()->getName(), array_merge(request()->all(), ['lang' => 'it'])) }}"
      ><img src="/images/flags-languages/it.svg" alt="Italian">Italian</a>
    </li>
    <li>
      <a
        class="dropdown-item"
        href="{{ route(\Illuminate\Support\Facades\Route::getCurrentRoute()->getName(), array_merge(request()->all(), ['lang' => 'de'])) }}"
      >
        <img src="/images/flags-languages/de.svg" alt="Deutsch">Deutsch</a>
    </li>
  </ul>
</div>