
<div class="section">

                <h2>Products</h2>
                <label for="booksAvailable">Books Available</label>
                <select name="booksAvailable" id="booksAvailable" class="dropDown">
                    <option value="">--- Select ---</option>
                    <option value="book1">The Hobbit</option>
                    <option value="book2">Lord of the rings</option>
                    <option value="book3">The Heir</option>
                    <option value="book4">A darker shade of magic</option>
                    <option value="book5">Neverwhere</option>
                </select>
                <br>
                <label for="">Book Type</label>
                <div id="radioButtons">
                    <input type="radio" name="bookType" id="paperback" value="paperback" checked><label for="paperback" class="radioLabel">Paperback</label>
                    <input type="radio" name="bookType" id="hardcover" value="hardcover"><label for="hardcover" class="radioLabel">Hardcover</label>
                    <input type="radio" name="bookType" id="kindle" value="kindle"><label for="kindle" class="radioLabel">Kindle</label>
                </div>
                <br>
                <label for="notebook">Notebook ($5 each)</label>
                <input type="number" class="textField" name="notebook" id="notebook" placeholder="Add Quantity" >
                <br>
            </div>
            <div>
                <p id="showCart"></p>
            </div>