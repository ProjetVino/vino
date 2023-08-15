<!-- popup.blade.php -->
<div id="popup" class="popup">
    <div class="popup-content">
        <span class="close" onclick="cacherPopup()">&times;</span>
        <h2>Ajouter au cellier</h2>
        <div id="message-container"></div>
        @if (Auth::user()->celliers->isEmpty())
            <div>
                <a href="{{ route('celliers.create') }}" class="text-container">
                    <img src="{{asset('assets/add.png')}}" alt="add">
                    Créer un cellier
                </a>
            </div>             
        @else
            <div class="formulaires">
                <label for="quantite">Quantité :</label>
                <input type="number" id="quantite" name="quantite" min=1 value="1" required  pattern="[0-9]+" oninput="validNumberInput(this)" onblur="validateAndCorrect(this)">
                <label for="cellier">Cellier :</label>
                <select id="cellier" name="cellier" required>
                    <option value="" selected>Coisir un cellier</option>
                    @foreach(Auth::user()->celliers as $cellier)
                        <option value="{{$cellier->id}}">{{$cellier->nom}}</option>
                    @endforeach
                </select>
                <!-- Ajouter les autres options de cellier ici -->
                </select>
                
                <input type="button" id="popup-ajouter" value="Ajouter">
            </div>
        @endif
    </div>
</div>
