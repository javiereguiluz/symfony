<div class="logs" data-filter-level="Emergency,Alert,Critical,Error,Warning,Notice,Info,Debug" data-filters>
    <!--
    <?php $channelIsDefined = isset($logs[0]['channel']); ?>
            <th data-filter="level">Level</th>
            <?php if ($channelIsDefined) { ?><th data-filter="channel">Channel</th><?php } ?>
-->
    <?php
    foreach ($logs as $log) {
        if ($log['priority'] >= 400) {
            $status = 'error';
        } elseif ($log['priority'] >= 300) {
            $status = 'warning';
        } else {
            $severity = 0;
            if (($exception = $log['context']['exception'] ?? null) instanceof \ErrorException || $exception instanceof \Symfony\Component\ErrorHandler\Exception\SilencedErrorContext) {
                $severity = $exception->getSeverity();
            }
            $status = \E_DEPRECATED === $severity || \E_USER_DEPRECATED === $severity ? 'warning' : 'normal';
        } ?>

        <div class="log status-<?= $status; ?>" data-filter-level="<?= strtolower($this->escape($log['priorityName'])); ?>"
            <?php if ($channelIsDefined) { ?> data-filter-channel="<?= $this->escape($log['channel']); ?>"<?php } ?>
            <?php if ('debug' === strtolower($log['priorityName'])) { ?> style="display: none"<?php } ?>
        >
            <p class="log-metadata nowrap">
                <span class="text-muted"><?= date('H:i:s', $log['timestamp']); ?></span>
                <span class="text-bold text-small text-<?= $status; ?>"><?= strtolower($this->escape($log['priorityName'])); ?></span>
                <?php if ($channelIsDefined) { ?>
                    <span><?= $this->escape($log['channel']); ?></span>
                <?php } ?>
            </p>
            <p class="log-message">
                <?= $this->formatLogMessage($log['message'], $log['context']); ?>
            </p>
            <?php if ($log['context']) { ?>
                <pre class="text-muted prewrap m-t-5"><?= $this->escape(json_encode($log['context'], \JSON_PRETTY_PRINT | \JSON_UNESCAPED_UNICODE | \JSON_UNESCAPED_SLASHES)); ?></pre>
            <?php } ?>
        </div>
        <?php
    } ?>
</div>
