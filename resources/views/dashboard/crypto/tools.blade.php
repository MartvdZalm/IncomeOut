<x-dashboard-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Crypto Trading Tools</h2>
            <a
                href="{{ route('crypto.index') }}"
                class="text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 text-sm font-medium"
            >
                ← Back to Crypto
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- TP/SL Calculator -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md dark:shadow-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                    Take Profit / Stop Loss Calculator
                </h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                    Calculate where to set your TP and SL based on desired profit and fees
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <x-form.input
                            id="entry_price"
                            label="Entry Price"
                            type="number"
                            step="0.00000001"
                            placeholder="0.00000000"
                        />

                        <x-form.input
                            id="desired_profit"
                            label="Desired Profit (USD)"
                            type="number"
                            step="0.01"
                            placeholder="0.00"
                        />

                        <x-form.input
                            id="position_size"
                            label="Position Size (Amount)"
                            type="number"
                            step="0.00000001"
                            placeholder="0.00000000"
                        />

                        <x-form.input
                            id="risk_reward"
                            label="Risk / Reward Ratio"
                            type="number"
                            step="0.1"
                            placeholder="2"
                        />

                        <x-form.input
                            id="maker_fee"
                            label="Maker Fee (%)"
                            type="number"
                            step="0.001"
                            value="0.1"
                            placeholder="0.1"
                        />

                        <x-form.input
                            id="taker_fee"
                            label="Taker Fee (%)"
                            type="number"
                            step="0.001"
                            value="0.1"
                            placeholder="0.1"
                        />

                        <button
                            onclick="calculateTPSL()"
                            class="w-full bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md"
                        >
                            Calculate TP/SL
                        </button>
                    </div>
                    <div class="space-y-4">
                        <div
                            class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4"
                        >
                            <h4 class="font-semibold text-green-900 dark:text-green-100 mb-2">Take Profit Price</h4>
                            <p id="tp_price" class="text-2xl font-bold text-green-600 dark:text-green-400">-</p>
                            <p id="tp_percentage" class="text-sm text-green-700 dark:text-green-300 mt-1">-</p>
                        </div>
                        <div
                            class="bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-lg p-4"
                        >
                            <h4 class="font-semibold text-red-900 dark:text-red-100 mb-2">Stop Loss Price</h4>
                            <p id="sl_price" class="text-2xl font-bold text-red-600 dark:text-red-400">-</p>
                            <p id="sl_percentage" class="text-sm text-red-700 dark:text-red-300 mt-1">-</p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 rounded-lg p-4"
                        >
                            <h4 class="font-semibold text-gray-900 dark:text-gray-100 mb-2">Total Fees</h4>
                            <p id="total_fees" class="text-xl font-semibold text-gray-700 dark:text-gray-300">-</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Entry + Exit fees</p>
                        </div>
                        <div
                            class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4"
                        >
                            <h4 class="font-semibold text-blue-900 dark:text-blue-100 mb-2">Net Profit</h4>
                            <p id="net_profit" class="text-xl font-semibold text-blue-600 dark:text-blue-400">-</p>
                            <p class="text-xs text-blue-700 dark:text-blue-300 mt-1">After fees</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Position Sizing Calculator -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md dark:shadow-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Position Sizing Calculator</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">
                    Calculate optimal position size based on risk management
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <x-form.input
                            id="account_balance"
                            label="Account Balance (USD)"
                            type="number"
                            step="0.01"
                            placeholder="10000.00"
                        />

                        <x-form.input
                            id="risk_percentage"
                            label="Risk Per Trade (%)"
                            type="number"
                            step="0.1"
                            value="1"
                            placeholder="1"
                        />

                        <x-form.input
                            id="entry_price_size"
                            label="Entry Price"
                            type="number"
                            step="0.00000001"
                            placeholder="0.00000000"
                        />

                        <x-form.input
                            id="stop_loss_price"
                            label="Stop Loss Price"
                            type="number"
                            step="0.00000001"
                            placeholder="0.00000000"
                        />

                        <button
                            onclick="calculatePositionSize()"
                            class="w-full bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md"
                        >
                            Calculate Position Size
                        </button>
                    </div>
                    <div class="space-y-4">
                        <div
                            class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4"
                        >
                            <h4 class="font-semibold text-blue-900 dark:text-blue-100 mb-2">Position Size</h4>
                            <p id="position_size_result" class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                                -
                            </p>
                            <p class="text-sm text-blue-700 dark:text-blue-300 mt-1">Amount to buy/sell</p>
                        </div>
                        <div
                            class="bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 rounded-lg p-4"
                        >
                            <h4 class="font-semibold text-gray-900 dark:text-gray-100 mb-2">Position Value</h4>
                            <p id="position_value" class="text-xl font-semibold text-gray-700 dark:text-gray-300">-</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">In USD</p>
                        </div>
                        <div
                            class="bg-orange-50 dark:bg-orange-900/20 border border-orange-200 dark:border-orange-800 rounded-lg p-4"
                        >
                            <h4 class="font-semibold text-orange-900 dark:text-orange-100 mb-2">Risk Amount</h4>
                            <p id="risk_amount" class="text-xl font-semibold text-orange-600 dark:text-orange-400">-</p>
                            <p class="text-xs text-orange-700 dark:text-orange-300 mt-1">Maximum loss</p>
                        </div>
                        <div
                            class="bg-purple-50 dark:bg-purple-900/20 border border-purple-200 dark:border-purple-800 rounded-lg p-4"
                        >
                            <h4 class="font-semibold text-purple-900 dark:text-purple-100 mb-2">
                                Risk/Reward Distance
                            </h4>
                            <p id="risk_distance" class="text-xl font-semibold text-purple-600 dark:text-purple-400">
                                -
                            </p>
                            <p class="text-xs text-purple-700 dark:text-purple-300 mt-1">Price difference</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Fee Calculator -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md dark:shadow-gray-700 p-6">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Trading Fee Calculator</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400 mb-6">Calculate trading fees for your trades</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <x-form.input
                            id="trade_amount"
                            label="Trade Amount (USD)"
                            type="number"
                            step="0.01"
                            placeholder="1000.00"
                        />

                        <x-form.input
                            id="fee_rate"
                            label="Fee Rate (%)"
                            type="number"
                            step="0.001"
                            value="0.1"
                            placeholder="0.1"
                        />

                        <x-form.select id="trade_type" label="Trade Type">
                            <option value="single">Single Trade (Buy or Sell)</option>
                            <option value="round">Round Trip (Buy + Sell)</option>
                        </x-form.select>

                        <x-form.select id="entry_fee_type" label="Entry Fee Type">
                            <option value="maker">Maker</option>
                            <option value="taker">Taker</option>
                        </x-form.select>

                        <x-form.select id="exit_fee_type" label="Exit Fee Type">
                            <option value="maker">Maker</option>
                            <option value="taker">Taker</option>
                        </x-form.select>

                        <x-form.input
                            id="price_change"
                            label="Exit Price Change (%)"
                            type="number"
                            step="0.1"
                            value="0"
                            placeholder="0"
                        />

                        <button
                            onclick="calculateFees()"
                            class="w-full bg-blue-600 hover:bg-blue-700 dark:bg-blue-500 dark:hover:bg-blue-600 text-white font-medium py-2 px-4 rounded-md"
                        >
                            Calculate Fees
                        </button>
                    </div>
                    <div class="space-y-4">
                        <x-alert id="fee_error"></x-alert>

                        <div
                            class="bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 rounded-lg p-4"
                        >
                            <h4 class="font-semibold text-gray-900 dark:text-gray-100 mb-2">Trading Fee</h4>
                            <p id="trading_fee" class="text-2xl font-bold text-gray-700 dark:text-gray-300">-</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Fee amount</p>
                        </div>
                        <div
                            class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg p-4"
                        >
                            <h4 class="font-semibold text-blue-900 dark:text-blue-100 mb-2">Net Amount</h4>
                            <p id="net_amount" class="text-xl font-semibold text-blue-600 dark:text-blue-400">-</p>
                            <p class="text-xs text-blue-700 dark:text-blue-300 mt-1">After fees</p>
                        </div>
                        <div
                            class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4"
                        >
                            <h4 class="font-semibold text-green-900 dark:text-green-100 mb-2">Fee Percentage</h4>
                            <p id="fee_percentage" class="text-xl font-semibold text-green-600 dark:text-green-400">
                                -
                            </p>
                            <p class="text-xs text-green-700 dark:text-green-300 mt-1">Of trade amount</p>
                        </div>
                        <div
                            class="bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 rounded-lg p-4"
                        >
                            <h4 class="font-semibold text-green-900 dark:text-green-100 mb-2">Breakeven Move</h4>
                            <p id="breakeven_move" class="text-xl font-semibold text-green-600 dark:text-green-400">
                                -
                            </p>
                            <p class="text-xs text-green-700 dark:text-green-300 mt-1">Minimum % move to cover fees</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function calculateTPSL() {
            const entryPrice = parseFloat(document.getElementById('entry_price').value);
            const desiredProfit = parseFloat(document.getElementById('desired_profit').value);
            const positionSize = parseFloat(document.getElementById('position_size').value);
            const makerFee = parseFloat(document.getElementById('maker_fee').value) / 100;
            const takerFee = parseFloat(document.getElementById('taker_fee').value) / 100;
            const riskReward = parseFloat(document.getElementById('risk_reward').value);

            if (isNaN(entryPrice) || isNaN(desiredProfit) || isNaN(positionSize) || isNaN(riskReward)) {
                alert('Please fill in all required fields correctly');
                return;
            }

            const entryValue = entryPrice * positionSize;

            const entryFee = entryValue * makerFee;

            const tpPrice = (desiredProfit + entryFee + entryPrice * positionSize) / (positionSize * (1 - takerFee));

            const exitValue = tpPrice * positionSize;
            const exitFee = exitValue * takerFee;

            const totalFees = entryFee + exitFee;

            const tpPercentage = ((tpPrice - entryPrice) / entryPrice) * 100;

            const riskAmount = desiredProfit / riskReward;

            const slPrice = entryPrice - riskAmount / positionSize;
            const slPercentage = ((entryPrice - slPrice) / entryPrice) * 100;

            const netProfit = (tpPrice - entryPrice) * positionSize - totalFees;

            document.getElementById('tp_price').textContent = tpPrice.toFixed(8);
            document.getElementById('tp_percentage').textContent = `+${tpPercentage.toFixed(2)}%`;

            document.getElementById('sl_price').textContent = slPrice.toFixed(8);
            document.getElementById('sl_percentage').textContent = `-${slPercentage.toFixed(2)}%`;

            document.getElementById('total_fees').textContent = '$' + totalFees.toFixed(2);
            document.getElementById('net_profit').textContent = '$' + netProfit.toFixed(2);
        }

        function calculatePositionSize() {
            const accountBalance = parseFloat(document.getElementById('account_balance').value);
            const riskPercentage = parseFloat(document.getElementById('risk_percentage').value) / 100;
            const entryPrice = parseFloat(document.getElementById('entry_price_size').value);
            const stopLossPrice = parseFloat(document.getElementById('stop_loss_price').value);

            if (isNaN(accountBalance) || isNaN(riskPercentage) || isNaN(entryPrice) || isNaN(stopLossPrice)) {
                alert('Please fill in all required fields correctly');
                return;
            }

            if (entryPrice === stopLossPrice) {
                alert('Entry and Stop Loss cannot be the same');
                return;
            }

            const riskAmount = accountBalance * riskPercentage;
            const priceDifference = Math.abs(entryPrice - stopLossPrice);

            const positionSize = riskAmount / priceDifference;
            const positionValue = positionSize * entryPrice;

            document.getElementById('position_size_result').textContent = positionSize.toFixed(8);
            document.getElementById('position_value').textContent = '$' + positionValue.toFixed(2);
            document.getElementById('risk_amount').textContent = '$' + riskAmount.toFixed(2);
            document.getElementById('risk_distance').textContent = priceDifference.toFixed(8);
        }

        function calculateFees() {
            const errorBox = document.getElementById('fee_error');
            errorBox.classList.add('hidden');
            errorBox.textContent = '';

            const tradeAmount = parseFloat(document.getElementById('trade_amount').value);
            const feeRate = parseFloat(document.getElementById('fee_rate').value) / 100;
            const tradeType = document.getElementById('trade_type').value;

            if (isNaN(tradeAmount) || tradeAmount <= 0) {
                showError('Please enter a valid trade amount.');
                return;
            }

            if (isNaN(feeRate) || feeRate < 0) {
                showError('Please enter a valid fee rate.');
                return;
            }

            let entryFee = tradeAmount * feeRate;
            let exitValue = tradeAmount;
            let exitFee = 0;

            if (tradeType === 'round') {
                exitFee = tradeAmount * feeRate;
            }

            const totalFee = entryFee + exitFee;
            const netAmount = tradeAmount - totalFee;
            const feePercentage = (totalFee / tradeAmount) * 100;
            const breakevenMove = feePercentage;

            document.getElementById('trading_fee').textContent = '$' + totalFee.toFixed(2);
            document.getElementById('net_amount').textContent = '$' + netAmount.toFixed(2);
            document.getElementById('fee_percentage').textContent = feePercentage.toFixed(3) + '%';
            document.getElementById('breakeven_move').textContent = breakevenMove.toFixed(3) + '%';

            function showError(message) {
                errorBox.textContent = message;
                errorBox.classList.remove('hidden');
            }
        }
    </script>
</x-dashboard-layout>
