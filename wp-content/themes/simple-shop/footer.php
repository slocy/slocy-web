		<!-- Footer -->
		<footer id="footer">

			<?php sds_footer_sidebar(); ?>

			<section class="copyright-area <?php echo ( is_active_sidebar( 'copyright-area-sidebar' ) ) ? 'widgets' : 'no-widgets'; ?>">
				<?php sds_copyright_area_sidebar(); ?>
			</section>

			<section class="copyright">
				<p class="copyright-message">
					<?php sds_copyright( 'Simple Shop' ); ?>
				</p>
			</section>
		</footer>

	<?php wp_footer(); ?>
	</body>
</html>