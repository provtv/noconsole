<div class="space-y-4">
    <div class="flex space-x-4 mb-6">
        <button onclick="check()" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">check</button>
        <button onclick="downloadComposer()" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">downloadComposer</button>
        <button onclick="extractComposer()" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 transition">extractComposer</button>
    </div>
    <?php foreach ($commands as $pack => $pack_cmds): ?>
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4"><?php echo htmlspecialchars($pack); ?> Commands</h2>
            <input type="text" 
                class="w-full px-4 py-2 border rounded mb-4 focus:ring-2 focus:ring-blue-500 focus:border-blue-500" 
                name="package" 
                id="<?php echo htmlspecialchars($pack); ?>_text" 
                placeholder="Enter package name...">
            <div class="flex flex-wrap gap-2">
                <?php foreach ($pack_cmds as $cmd): ?>
                    <button onclick="callPack('<?php echo htmlspecialchars($cmd); ?>','<?php echo htmlspecialchars($pack); ?>')" 
                        class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600 transition">
                        <?php echo htmlspecialchars($cmd); ?>
                    </button>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="mt-8">
        <h3 class="text-xl font-semibold text-gray-800 mb-4">Console Output:</h3>
        <pre id="output" class="bg-gray-900 text-gray-100 p-4 rounded-lg overflow-x-auto"></pre>
    </div>
</div> 