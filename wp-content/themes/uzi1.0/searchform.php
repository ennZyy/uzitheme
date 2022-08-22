<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ) ?>">
        <div class="header__search" id="searchFeild">
            <input type="text" name="s" id="s" placeholder="Я ищу...">
            <input type="hidden" value="product, post" name="post_type" />
            <input type="hidden" value="1" name="sentence" />
            <button>
                Найти
            </button>

            <div class="close" id="searchFieldClose">
                <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="1.9206" height="19.206" rx="0.960302" transform="matrix(0.710018 0.704183 -0.710018 0.704183 13.6367 0)" fill="#2F2F2F"/>
                    <rect width="1.9206" height="19.206" rx="0.960302" transform="matrix(0.710018 -0.704183 0.710018 0.704183 0 1.47559)" fill="#2F2F2F"/>
                </svg>
            </div>

        </div>
    </form>