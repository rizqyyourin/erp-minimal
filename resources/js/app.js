import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
	const loadingBar = document.getElementById('app-loading-bar');
	const loadingProgress = document.getElementById('app-loading-bar-progress');

	if (!loadingBar || !loadingProgress) {
		return;
	}

	let progressTimer = null;
	let isLoading = false;

	const resetLoadingBar = () => {
		isLoading = false;
		window.clearInterval(progressTimer);
		progressTimer = null;
		loadingProgress.style.width = '0%';
		loadingBar.classList.remove('is-visible');
	};

	const startLoadingBar = () => {
		if (isLoading) {
			return;
		}

		isLoading = true;
		loadingBar.classList.add('is-visible');
		loadingProgress.style.width = '18%';

		progressTimer = window.setInterval(() => {
			const currentWidth = Number.parseFloat(loadingProgress.style.width) || 0;

			if (currentWidth < 82) {
				const nextWidth = Math.min(currentWidth + Math.random() * 12, 82);
				loadingProgress.style.width = `${nextWidth}%`;
			}
		}, 180);
	};

	const completeLoadingBar = () => {
		if (!isLoading) {
			resetLoadingBar();
			return;
		}

		window.clearInterval(progressTimer);
		progressTimer = null;
		loadingProgress.style.width = '100%';

		window.setTimeout(() => {
			resetLoadingBar();
		}, 220);
	};

	const isNavigableLink = (link) => {
		if (!link || !link.href) {
			return false;
		}

		if (link.target === '_blank' || link.hasAttribute('download')) {
			return false;
		}

		if (link.getAttribute('href')?.startsWith('#') || link.getAttribute('href')?.startsWith('javascript:')) {
			return false;
		}

		const url = new URL(link.href, window.location.origin);

		if (url.origin !== window.location.origin) {
			return false;
		}

		return url.href !== window.location.href;
	};

	document.addEventListener('click', (event) => {
		const link = event.target.closest('a');

		if (!isNavigableLink(link)) {
			return;
		}

		startLoadingBar();
	});

	document.addEventListener('submit', (event) => {
		const form = event.target;

		if (!(form instanceof HTMLFormElement)) {
			return;
		}

		startLoadingBar();
	});

	window.addEventListener('pageshow', completeLoadingBar);
	window.addEventListener('load', completeLoadingBar);
});
