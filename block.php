<?php

/**
 *
 * Flextype Block Plugin
 *
 * @author Romanenko Sergey / Awilum <awilum@yandex.ru>
 * @link http://flextype.org
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Flextype;

use Thunder\Shortcode\Shortcode\ShortcodeInterface;
use Flextype\Component\{Event\Event, Filesystem\Filesystem};

// Event: onShortcodesInitialized
Event::addListener('onShortcodesInitialized', function () {

    // Shortcode: [block name=block-name]
    Content::shortcode()->addHandler('block', function(ShortcodeInterface $s) {
        return Block::get($s->getParameter('name'), (($s->getParameter('raw') === 'true') ? true : false));
    });
});

class Block
{
    /**
     * Get block
     *
     * echo Block::get('block-name');
     *
     * @access public
     * @param  string  $block_name  Block name
     * @param  bool    $raw  Raw or not raw content
     * @return string
     */
    public static function get($block_name, $raw = false) : string
    {
        $block_path = PATH['site'] . '/blocks/' . $block_name . '.md';

        // Block cache id
        $block_cache_id = '';

        if (Filesystem::fileExists($block_path)) {

            // Create cache id for block
            $block_cache_id = md5('block' . $block_path . filemtime($block_path) . (($raw === true) ? 'true' : 'false'));

            // Try to get block from cache
            if (Cache::contains($block_cache_id)) {
                return Cache::fetch($block_cache_id);
            } else {
                $content = Filesystem::getFileContent($block_path);

                if ($raw === false) {
                    $content = Content::processContent($content);
                }

                Cache::save($block_cache_id, $content);
                return $content;
            }
        } else {
            throw new \RuntimeException("Block {$block_name} does not exist.");
        }
    }
}
