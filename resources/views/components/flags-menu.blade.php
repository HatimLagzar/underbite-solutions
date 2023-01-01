<div class="dropdown">
  <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    @if(app()->getLocale() === 'fr')
      <img width="20" src="/images/flags-languages/fr.svg" alt="French"> French
    @elseif(app()->getLocale() === 'ar')
      <img width="20" src="/images/flags-languages/ar.svg" alt="Arabic"> Arabic
    @elseif(app()->getLocale() === 'es')
      <img width="20" src="/images/flags-languages/es.svg" alt="Spanish"> Spanish
    @elseif(app()->getLocale() === 'de')
      <img width="20" src="/images/flags-languages/de.svg" alt="Deutsch"> Deutsch
    @elseif(app()->getLocale() === 'it')
      <img width="20" src="/images/flags-languages/it.svg" alt="Italian"> Italian
    @else
      <img width="20" src="/images/flags-languages/en.svg" alt="English"> English
    @endif
  </button>
  <ul class="dropdown-menu" aria-labelledby="flags-dropdown" id="flags-dowpdown-list">
    <li>
      <a
        class="dropdown-item"
        href="{{ route(\Illuminate\Support\Facades\Route::getCurrentRoute()->getName(), array_merge(\Illuminate\Support\Facades\Route::getCurrentRoute()->parameters(), ['locale' => 'en'])) }}"
      >
        <img src="/images/flags-languages/en.svg" alt="English">English
      </a>
    </li>
    <li>
      <a
        class="dropdown-item"
        href="{{ route(\Illuminate\Support\Facades\Route::getCurrentRoute()->getName(), array_merge(\Illuminate\Support\Facades\Route::getCurrentRoute()->parameters(), ['locale' => 'fr'])) }}"
      >
        <img src="/images/flags-languages/fr.svg" alt="French">French
      </a>
    </li>
    <li>
      <a
        class="dropdown-item"
        href="{{ route(\Illuminate\Support\Facades\Route::getCurrentRoute()->getName(), array_merge(\Illuminate\Support\Facades\Route::getCurrentRoute()->parameters(), ['locale' => 'es'])) }}"
      >
        <img src="/images/flags-languages/es.svg" alt="Spanish">Spanish
      </a>
    </li>
    <li><a class="dropdown-item"
           href="{{ route(\Illuminate\Support\Facades\Route::getCurrentRoute()->getName(), array_merge(\Illuminate\Support\Facades\Route::getCurrentRoute()->parameters(), ['locale' => 'it'])) }}"
      ><img src="/images/flags-languages/it.svg" alt="Italian">Italian</a>
    </li>
    <li>
      <a
        class="dropdown-item"
        href="{{ route(\Illuminate\Support\Facades\Route::getCurrentRoute()->getName(), array_merge(\Illuminate\Support\Facades\Route::getCurrentRoute()->parameters(), ['locale' => 'de'])) }}"
      >
        <img src="/images/flags-languages/de.svg" alt="Deutsch">Deutsch</a>
    </li>
  </ul>
</div>