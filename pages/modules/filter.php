<div class="filter-wrapper">
    <form action="<?php echo "index.php?" . $_SERVER["QUERY_STRING"] ?>" class="filter-form" id="filter-form" method="POST">


        <div class="filter-item">
            <div class="filter-item-title">
                <i class="fa-solid fa-square"></i> Ram
            </div>
            <div class="filter-item-wrapper">
                <div class="filter-item-content">
                    <div class="filter-input-wrapper">
                        <input type="checkbox" name="ram[]" id="ram8gb" value="8GB" />
                        <label for="ram8gb">8GB</label>
                    </div>
                    <div class="filter-input-wrapper">
                        <input type="checkbox" name="ram[]" id="ram16gb" value="16GB" />
                        <label for="ram16gb">16GB</label>
                    </div>
                    <div class="filter-input-wrapper">
                        <input type="checkbox" name="ram[]" id="ram32gb" value="32GB" />
                        <label for="ram32gb">32GB</label>
                    </div>

                    <div class="filter-input-wrapper">
                        <input type="checkbox" name="ram[]" id="ram64gb" value="64GB" />
                        <label for="ram64gb">64GB</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="filter-item">
            <div class="filter-item-title">
                <i class="fa-solid fa-square"></i> Screen
            </div>
            <div class="filter-item-wrapper">
                <div class="filter-item-content">
                    <div class="filter-input-wrapper">
                        <input type="checkbox" name="screen[]" id="13.3inch" value='13.3 inch' />
                        <label for="13.3inch">13.3 inch</label>
                    </div>
                    <div class="filter-input-wrapper">
                        <input type="checkbox" name="screen[]" id="14inch" value='14 inch' />
                        <label for="14inch">14 inch</label>
                    </div>

                    <div class="filter-input-wrapper">
                        <input type="checkbox" name="screen[]" id="15.6inch" value='15.6 inch' />
                        <label for="15.6inch">15.6 inch</label>
                    </div>

                    <div class="filter-input-wrapper">
                        <input type="checkbox" name="screen[]" id="16inch" value='16 inch' />
                        <label for="16inch">16 inch</label>
                    </div>

                    <div class="filter-input-wrapper">
                        <input type="checkbox" name="screen[]" id="17.3inch" value='17.3 inch' />
                        <label for="17.3inch">17.3 inch</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="filter-item">
            <div class="filter-item-title">
                <i class="fa-solid fa-square"></i> Cpu
            </div>
            <div class="filter-item-wrapper">
                <div class="filter-item-content">
                    <div class="filter-input-wrapper">
                        <input type="checkbox" name="cpu[]" id="corei3" value="Core i3" />
                        <label for="corei3">Intel Core i3</label>
                    </div>

                    <div class="filter-input-wrapper">
                        <input type="checkbox" name="cpu[]" id="corei5" value="Core i5" />
                        <label for="corei5">Intel Core i5</label>
                    </div>

                    <div class="filter-input-wrapper">
                        <input type="checkbox" name="cpu[]" id="corei7" value="Core i7" />
                        <label for="corei7">Intel Core i7</label>
                    </div>

                    <div class="filter-input-wrapper">
                        <input type="checkbox" name="cpu[]" id="corei9" value="Core i9" />
                        <label for="corei9">Intel Core i9</label>
                    </div>

                    <div class="filter-input-wrapper">
                        <input type="checkbox" name="cpu[]" id="ry5" value="Ryzen 5" />
                        <label for="ry5">AMD Ryzen 5</label>
                    </div>

                    <div class="filter-input-wrapper">
                        <input type="checkbox" name="cpu[]" id="ry7" value="Ryzen 7" />
                        <label for="ry7">AMD Ryzen 7</label>
                    </div>

                    <div class="filter-input-wrapper">
                        <input type="checkbox" name="cpu[]" id="ry9" value="Ryzen 9" />
                        <label for="ry9">AMD Ryzen 9</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="filter-item">
            <div class="filter-item-title">
                <i class="fa-solid fa-square"></i> Memory
            </div>
            <div class="filter-item-wrapper">
                <div class="filter-item-content">
                    <!-- <div class="filter-input-wrapper">
            <input
                type="checkbox"
                name="drive[]"
                id="ssd128gb"
                value="128GB"
            />
            <label for="ssd128gb">SSD 128 GB</label>
            </div>

            <div class="filter-input-wrapper">
            <input
                type="checkbox"
                name="drive[]"
                id="ssd256gb"
                value="256GB"
            />
            <label for="ssd256gb">SSD 256 GB</label>
            </div> -->

                    <div class="filter-input-wrapper">
                        <input type="checkbox" name="drive[]" id="ssd512gb" value="512GB" />
                        <label for="ssd512gb">SSD 512 GB</label>
                    </div>

                    <div class="filter-input-wrapper">
                        <input type="checkbox" name="drive[]" id="ssd1tb" value="1TB" />
                        <label for="ssd1tb">SSD 1 TB</label>
                    </div>

                    <div class="filter-input-wrapper">
                        <input type="checkbox" name="drive[]" id="ssd2tb" value="2TB" />
                        <label for="ssd2tb">SSD 2 TB</label>
                    </div>

                    <div class="filter-input-wrapper">
                        <input type="checkbox" name="drive[]" id="ssd4tb" value="4TB" />
                        <label for="ssd4tb">SSD 4 TB</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="filter-item filter-sort">
            <div class="filter-item-title">
                <i class="fa-solid fa-square"></i> Sort by
            </div>
            <div class="filter-item-wrapper">
                <div class="filter-item-content">
                    <div class="filter-input-wrapper">
                        <input type="radio" id="none" value="" name="sort" checked />
                        <label for="none">Default</label>
                    </div>
                    <div class="filter-input-wrapper">
                        <input type="radio" name="sort" id="DESC" value="DESC" />
                        <label for="DESC">High - Low (price)</label>
                    </div>

                    <div class="filter-input-wrapper">
                        <input type="radio" name="sort" id="ASC" value="ASC" />
                        <label for="ASC">Low - High (price)</label>
                    </div>

                    <div class="filter-input-wrapper">
                        <input type="radio" name="sort" id="discount" value="discount" />
                        <label for="discount">% discount</label>
                    </div>
                </div>
            </div>
        </div>

        <div class="filter-item filter-price">
            <div class="filter-item-title">
                <i class="fa-solid fa-square"></i> Price
            </div>
            <div class="filter-item-wrapper">
                <div class="filter-item-content">
                    <div class="display">
                        <span id="min">5.000.000đ</span>
                        <span id="max">150.000.000đ</span>
                    </div>
                    <div class="range-slide">
                        <div class="slide">
                            <div class="line" id="line" style="left: 0%; right: 0%"></div>
                            <span class="thumb" id="thumbMin" style="left: 0%"></span>
                            <span class="thumb" id="thumbMax" style="left: 100%"></span>
                        </div>
                        <input id="rangeMin" type="range" max="150000000" min="5000000" step="100000" value="5000000" name="min" />
                        <input id="rangeMax" type="range" max="150000000" min="5000000" step="100000" value="150000000" name="max" />
                    </div>
                </div>
            </div>
        </div>



        <button type="submit" name='submit' value="filter">Filter</button>
        <button class="clear-filter" id="clear-filter" name='clear' value='clear'>Clear Filter</button>
    </form>
</div>