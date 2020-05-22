<div class="app-header-left">
    <div class="search-wrapper">
        <div class="input-holder">
            <input type="text" class="search-input" placeholder="Type to search">
            <button class="search-icon"><span></span></button>
        </div>
        <button class="close"></button>
    </div>
    <ul class="header-menu nav">
        <li class="nav-item">
            <a href="javascript:void(0);" class="nav-link">
                <i class="nav-link-icon fa fa-database"> </i>
                Statistics
            </a>
        </li>
        <li class="dropdown nav-item">
            <a href="javascript:void(0);" class="nav-link">
                <i class="nav-link-icon fa fa-cog"></i>
                Settings
            </a>
        </li>
    </ul>
</div>


{{--<select class="selectpicker">
    <option>Mustard</option>
    <option>Ketchup</option>

</select>--}}
<!-- Right Side Of Navbar -->
{{--<ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown"
           aria-haspopup="true" aria-expanded="false" v-pre>
            Language <span class="caret"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ url('locale/en') }}">
                <img src="{{asset('us.png')}}" style="position: relative;
    display: inline-block;
    line-height: 1em;" width="30px" height="30x"></a>
            <a class="dropdown-item" href="{{ url('locale/fr') }}"><img src="{{asset('fr.png')}}" width="30px"
                                                                        height="30x"></a>
        </div>
    </li>
</ul>--}}

<!-- Right Side Of Navbar -->
<ul class="navbar-nav ml-auto">
    <!-- Authentication Links -->
    @php $locale = session()->get('locale'); @endphp
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            @switch($locale)
                @case('fr')
                <img src="{{asset('fr.png')}}" width="30px" height="20x">
                @break
                @default
                <img src="{{asset('us.png')}}" width="30px" height="20x">
            @endswitch
            <span class="caret"></span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ url('locale/en') }}"><img src="{{asset('us.png')}}" width="30px" height="20x"> </a>
            <a class="dropdown-item" href="{{ url('locale/fr') }}"><img src="{{asset('fr.png')}}" width="30px" height="20x"></a>
        </div>
    </li>
</ul>
