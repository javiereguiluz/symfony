<?php /* ?>
<div class="exception-summary <?= !$exceptionMessage ? 'exception-without-message' : ''; ?>">
    <div class="exception-message-wrapper">
        <div class="container">
            <h1 class="break-long-words exception-message<?= mb_strlen($exceptionMessage) > 180 ? ' long' : ''; ?>"><?= $this->formatFileFromText(nl2br($exceptionMessage)); ?></h1>

            <div class="exception-illustration hidden-xs-down">
                <?= $this->include('assets/images/symfony-ghost.svg.php'); ?>
            </div>
        </div>
    </div>
</div>
<?php */ ?>

<div class="container">
    <div class="traces-log-container">
        <div class="traces-wrapper">

        </div>

        <div class="logs-wrapper">
            <?php if ($request): ?>
                <div>
                    <div class="divider">
                        <div class="divider-label">Request HTTP Headers</div>
                        <div class="divider-line"></div>
                    </div>

                    <div class="http-header-list">
                        <?php $httpRequests = $request->headers->all(); ksort($httpRequests); ?>
                        <?php foreach ($httpRequests as $key => $values): ?>
                            <span class="http-header">
                                <strong><?= $this->escape($key) ?></strong>
                                <?= $this->escape(implode(', ', $values)) ?>
                            </span>
                        <?php endforeach; ?>
                    </div>

                    <button id="toggle-http-headers" class="btn">
                        <span>View all &rarr;</span>
                    </button>

                    <div id="http-headers-panel" style="display: none; margin-top: 10px; padding: 10px; background: var(--base-1); border-radius: 4px;">
                        <?php if ($request && $request->headers->all()): ?>
                            <?php foreach ($request->headers->all() as $key => $values): ?>
                                <tr>
                                    <td style="padding-right: 20px;"><?= htmlspecialchars($key) ?></td>
                                    <td><?= htmlspecialchars(implode(', ', $values)) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p>No HTTP headers available</p>
                        <?php endif; ?>
                    </div>

                    <script>
                        document.getElementById('toggle-http-headers').addEventListener('click', function() {
                            const panel = document.getElementById('http-headers-panel');
                            if (panel.style.display === 'none') {
                                panel.style.display = 'block';
                                this.classList.add('active');
                            } else {
                                panel.style.display = 'none';
                                this.classList.remove('active');
                            }
                        });
                    </script>
                </div>
            <?php endif; ?>

            <?php if ($logger?->getLogs()): ?>
                <div class="divider">
                    <div class="divider-label">Logs</div>
                    <div class="divider-line"></div>
                </div>

                <?= $this->include('views/logs.html.php', ['logs' => $logger->getLogs()]) ?>
            <?php else: ?>
                <div class="empty">
                    <p>No log messages</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php /* ?>
<div class="container">
    <div class="sf-tabs">
        <div class="tab">
            <?php
            $exceptionAsArray = $exception->toArray();
            $exceptionWithUserCode = [];
            $exceptionAsArrayCount = count($exceptionAsArray);
            $last = $exceptionAsArrayCount - 1;
            foreach ($exceptionAsArray as $i => $e) {
                foreach ($e['trace'] as $trace) {
                    if ($trace['file'] && !str_contains($trace['file'], '/vendor/') && !str_contains($trace['file'], '/var/cache/') && $i < $last) {
                        $exceptionWithUserCode[] = $i;
                    }
                }
            }
            ?>
            <h3 class="tab-title">
                <?php if ($exceptionAsArrayCount > 1) { ?>
                    Exceptions <span class="badge"><?= $exceptionAsArrayCount; ?></span>
                <?php } else { ?>
                    Exception
                <?php } ?>
            </h3>

            <div class="tab-content">
                <?php
                foreach ($exceptionAsArray as $i => $e) {
                    echo $this->include('views/traces.html.php', [
                        'exception' => $e,
                        'index' => $i + 1,
                        'expand' => in_array($i, $exceptionWithUserCode, true) || ([] === $exceptionWithUserCode && 0 === $i),
                    ]);
                }
                ?>
            </div>
        </div>

        <?php if ($logger) { ?>
        <div class="tab <?= !$logger->getLogs() ? 'disabled' : ''; ?>">
            <h3 class="tab-title">
                Logs
                <?php if ($logger->countErrors()) { ?><span class="badge status-error"><?= $logger->countErrors(); ?></span><?php } ?>
            </h3>

            <div class="tab-content">
                <?php if ($logger->getLogs()) { ?>
                    <?= $this->include('views/logs.html.php', ['logs' => $logger->getLogs()]); ?>
                <?php } else { ?>
                    <div class="empty">
                        <p>No log messages</p>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php } ?>

        <div class="tab">
            <h3 class="tab-title">
                <?php if ($exceptionAsArrayCount > 1) { ?>
                    Stack Traces <span class="badge"><?= $exceptionAsArrayCount; ?></span>
                <?php } else { ?>
                    Stack Trace
                <?php } ?>
            </h3>

            <div class="tab-content">
                <?php
                foreach ($exceptionAsArray as $i => $e) {
                    echo $this->include('views/traces_text.html.php', [
                        'exception' => $e,
                        'index' => $i + 1,
                        'numExceptions' => $exceptionAsArrayCount,
                    ]);
                }
                ?>
            </div>
        </div>

        <?php if ($currentContent) { ?>
        <div class="tab">
            <h3 class="tab-title">Output content</h3>

            <div class="tab-content">
                <?= $currentContent; ?>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<?php */ ?>
