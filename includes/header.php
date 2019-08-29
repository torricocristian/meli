<header role="search-box" class="nav">
<input type="hidden" id="domain" value="<?= $baseURL ?>">
        <div class="container">
          <a class="nav-logo" href="<?= $baseURL ?>">Mercado Libre Argentina - Donde comprar y vender de todo</a>
          <form class="nav-search" action="<?= $baseURL ?>" method="GET" role="search">
              <input type="text" class="nav-search-input" name="q" placeholder="Nunca dejes de buscar" maxLength="120" autofocus="" autoCapitalize="off" autoCorrect="off" spellcheck="false" autoComplete="off" />
              <button type="submit" class="nav-search-btn">
                  <div role="img" aria-label="Buscar" class="nav-icon-search"></div>
              </button>
          </form>
        </div>
    </header>
